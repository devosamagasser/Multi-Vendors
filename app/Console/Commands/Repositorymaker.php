<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Repositorymaker extends Command
{
    protected $signature = 'create:repo {name}';
    protected $description = 'Create a new repository and corresponding interface';

    public function handle()
    {
        $baseName = $this->argument('name');

        $interfaceName = $this->interfaceMaker($baseName);
        if (!$interfaceName) return; // Exit if interface already exists

        $repoName = $this->repositoryMaker($baseName, $interfaceName);
        if (!$repoName) return; // Exit if repository already exists

        $this->updateServiceProvider($repoName, $interfaceName);

        $this->info("Repository {$baseName} created successfully!");
    }

    private function interfaceMaker($baseName)
    {
        // Parse the provided name to get the directory and the class name
        $interfaceName = class_basename($baseName) . 'Interface';
        $directoryPath = app_path('Interfaces/' . Str::replaceFirst(class_basename($baseName), '', $baseName));
        $interfacePath = $directoryPath . "{$interfaceName}.php";

        // Ensure the directory exists
        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0755, true);
        }

        if (File::exists($interfacePath)) {
            $this->error("Interface {$interfaceName} already exists!");
            return null;
        }

        $interfaceContent = <<<EOD
<?php

namespace App\Interfaces{$this->formatNamespace($baseName)};

interface {$interfaceName}
{
    // Define your interface methods here
}
EOD;

        File::put($interfacePath, $interfaceContent);
        return $interfaceName;
    }

    private function repositoryMaker($base, $interface)
    {
        $repoName = class_basename($base) . 'Repository';
        $directoryPath = app_path('Repositories/' . Str::replaceFirst(class_basename($base), '', $base));
        $repoPath = $directoryPath . "{$repoName}.php";

        // Ensure the directory exists
        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0755, true);
        }

        if (File::exists($repoPath)) {
            $this->error("Repository {$repoName} already exists!");
            return null;
        }

        $repoContent = <<<EOD
<?php

namespace App\Repositories{$this->formatNamespace($base)};
use App\Interfaces{$this->formatNamespace($base)}\\{$interface};

class {$repoName} implements {$interface}
{
    // Define your repository methods here
}
EOD;

        File::put($repoPath, $repoContent);
        return $repoName;
    }

    private function updateServiceProvider($repoName, $interfaceName)
    {
        $interfacePath = "App\\Interfaces" . $this->formatNamespace($interfaceName, '\\') . class_basename($interfaceName);
        $repoPath = "App\\Repositories" . $this->formatNamespace($repoName, '\\') . class_basename($repoName);

        $serviceProviderPath = app_path('Providers/RepositoryServiceProvider.php');

        if (!File::exists($serviceProviderPath)) {
            $this->error("RepositoryServiceProvider does not exist!");
            return;
        }

        $serviceProviderContent = File::get($serviceProviderPath);

        // Check if binding already exists
        if (strpos($serviceProviderContent, $interfacePath) !== false) {
            $this->info("Binding for {$interfaceName} already exists in the service provider.");
            return;
        }

        $binding = "\$this->app->bind(\n            '{$interfacePath}',\n            '{$repoPath}',\n        );\n";

        // Insert the binding just before the closing brace of the register method
        $pattern = '/(public function register\(\)\s*:\s*void\s*\{)(.*)(\})/s';
        $replacement = "\$1\n        {$binding}\n\$2\n\$3";
        $updatedServiceProviderContent = preg_replace($pattern, $replacement, $serviceProviderContent, 1);

        File::put($serviceProviderPath, $updatedServiceProviderContent);

        $this->info("Service provider updated with binding for {$interfaceName} and {$repoName}");
    }

    /**
     * Format the namespace for the generated file.
     */
    private function formatNamespace($name, $separator = '\\')
    {
        $name = Str::replaceFirst(class_basename($name), '', $name);
        return $name ? $separator . str_replace('/', $separator, trim($name, '/')) : '';
    }
}
