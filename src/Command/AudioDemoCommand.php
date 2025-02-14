<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

#[AsCommand(
    name: 'app:create-audio',
    description: 'Crée un fichier audio avec ElevenLabs API',
)]
class AudioDemoCommand extends Command
{
    private const ELEVENLABS_API_URL = 'https://api.elevenlabs.io/v1/text-to-speech';
    private string $elevenLabsApiKey;
    
    public function __construct(
        private HttpClientInterface $httpClient,
        private ParameterBagInterface $params
    ) {
        parent::__construct();
        $this->elevenLabsApiKey = $this->params->get('ELEVENLABS');
    }

    protected function configure(): void
    {
        $this
            ->addArgument('text', InputArgument::REQUIRED, 'Le texte à convertir en audio')
            ->addArgument('voice-id', InputArgument::REQUIRED, 'L\'ID de la voix ElevenLabs à utiliser')
            ->addArgument('output', InputArgument::REQUIRED, 'Le chemin du fichier de sortie (ex: output.mp3)')
            ->addOption('model', 'm', InputArgument::OPTIONAL, 'Le modèle à utiliser', 'eleven_monolingual_v1');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        
        $text = $input->getArgument('text');
        $voiceId = $input->getArgument('voice-id');
        $outputPath = $input->getArgument('output');
        $model = $input->getOption('model');

        try {
            $io->info('Génération du fichier audio en cours...');

            $response = $this->httpClient->request('POST', self::ELEVENLABS_API_URL . "/{$voiceId}", [
                'headers' => [
                    'Accept' => 'audio/mpeg',
                    'xi-api-key' => $this->elevenLabsApiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'text' => $text,
                    'model_id' => $model,
                    'voice_settings' => [
                        'stability' => 0.5,
                        'similarity_boost' => 0.5
                    ]
                ]
            ]);

            if ($response->getStatusCode() === 200) {
                file_put_contents($outputPath, $response->getContent());
                $io->success(sprintf('Fichier audio créé avec succès: %s', $outputPath));
                return Command::SUCCESS;
            }

            $io->error('Erreur lors de la génération du fichier audio');
            return Command::FAILURE;

        } catch (\Exception $e) {
            $io->error(sprintf('Une erreur est survenue: %s', $e->getMessage()));
            return Command::FAILURE;
        }
    }
}