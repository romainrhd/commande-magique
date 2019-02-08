<?php

namespace CommandeMagique\Installer\Console;

use ZipArchive;
use RuntimeException;
use GuzzleHttp\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InstallerCommand extends Command
{
    protected function configure()
    {
        $this->setName('new')
             ->setDescription('Create a new web Laravel project with a Docker stack')
             ->addArgument('name', InputArgument::OPTIONAL);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!class_exists(ZipArchive::class)) {
            throw new RuntimeException('The Zip PHP extension is not installed. Please install it and try again.');
        }

        $directory = ($input->getArgument('name')) ? getcwd().'/'.$input->getArgument('name') : getcwd();

        $this->verifyApplicationDoesntExist($directory);

        $output->writeln('<info>Crafting application...</info>');

        $this->download($zipFile = $this->makeFilename())
             ->extract($zipFile, $input->getArgument('name'))
             ->cleanUp($zipFile);
    }

    /**
     * Vérifie que l'application n'existe pas déjà.
     *
     * @param  string  $directory
     * @return void
     */
    protected function verifyApplicationDoesntExist($directory)
    {
        if ((is_dir($directory) || is_file($directory)) && $directory != getcwd()) {
            throw new RuntimeException('Application already exists!');
        }
    }

    /**
     * Generate a random temporary filename.
     *
     * @return string
     */
    protected function makeFilename()
    {
        return getcwd().'/project_'.md5(time().uniqid()).'.zip';
    }

    /**
     * Download the temporary Zip to the given file.
     *
     * @param  string  $zipFile
     * @return $this
     */
    protected function download($zipFile)
    {
        $response = (new Client)->get('https://github.com/romainrhd/laravel-docker/archive/develop.zip');
        file_put_contents($zipFile, $response->getBody());
        return $this;
    }

    /**
     * Extract the Zip file into the given directory.
     *
     * @param  string $zipFile
     * @param $directoryName
     * @return $this
     */
    protected function extract($zipFile, $directoryName)
    {
        $archive = new ZipArchive;
        $archive->open($zipFile);
        $archive->extractTo(getcwd());
        rename($archive->getNameIndex(0), $directoryName);
        $archive->close();

        return $this;
    }

    /**
     * Clean-up the Zip file.
     *
     * @param  string  $zipFile
     * @return $this
     */
    protected function cleanUp($zipFile)
    {
        @chmod($zipFile, 0777);
        @unlink($zipFile);
        return $this;
    }
}