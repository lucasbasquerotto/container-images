<?php
declare(strict_types=1);

if (basename($_SERVER['REQUEST_URI']) === 'adminer.css' && is_readable('adminer.css')) {
    header('Content-Type: text/css');
    readfile(__DIR__ . '/adminer.css');
    exit;
}

function adminer_object(): Adminer {
    return new class extends Adminer {
        public function name(): ?string {
            return $this->getEnv('ADMINER_NAME') ?? parent::name();
        }

        private function readFileContent(string $file): string {
            $handle = null;

            try {
                $handle = fopen(file, "r");
                $result = '';

                if ($handle) {
                    while (($line = fgets($handle)) !== false) {
                        $result = $result . $line . '\n';
                    }
                } else {
                    throw new Exception('file could not be opened: ' . $file);
                }
            } finally {
                if ($handle) {
                    fclose($handle);
                }
            }
        }

        public function loginForm(): void {
            parent::loginForm();

            if ($this->getEnv('ADMINER_AUTOLOGIN')) {
                echo script('
                    document.addEventListener(\'DOMContentLoaded\', function () {
                        document.forms[0].submit()
                    })
                ');
            }
        }

        public function loginFormField($name, $heading, $value): string {
            $envValue = $this->getLoginConfigValue($name);

            if ($envValue !== null) {
                $value = sprintf(
                    '<input name="auth[%s]" type="%s" value="%s">',
                    h($name),
                    h($name === 'password' ? 'password' : 'text'),
                    h($envValue)
                );
            }

            return parent::loginFormField($name, $heading, $value);
        }

        public function getLoginConfigValue(string $key): ?string {
            $pass = $this->getEnv('ADMINER_PASSWORD');
            $passFile = $this->getEnv('ADMINER_PASSWORD_FILE');

            // if ($passFile) {
            //     $passFilePath = if (strncmp($passFile, "/", 1) === 0)
            //         ? ('/run/secrets/' . $passFile)
            //         : $passFile;
            //     $pass = $this.readFileContent($passFilePath);
            // }

            switch ($key) {
                case 'db': return $this->getEnv('ADMINER_DB');
                case 'driver': return $this->getEnv('ADMINER_DRIVER');
                case 'password': return $pass;
                case 'server': return $this->getEnv('ADMINER_SERVER');
                case 'username': return $this->getEnv('ADMINER_USERNAME');
                case 'name': return $this->getEnv('ADMINER_NAME');
                default: return null;
            }
        }

        private function getEnv(string $key): ?string {
            return getenv($key) ?: null;
        }
    };
}

require __DIR__ . '/adminer.php';