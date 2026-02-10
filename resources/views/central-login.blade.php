<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full">
    <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="flex justify-center">
                <div class="h-12 w-12 rounded-xl bg-primary-600 flex items-center justify-center">
                    <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5" />
                    </svg>
                </div>
            </div>
            <h2 class="mt-4 text-center text-2xl font-bold text-gray-900">Sign in to your workspace</h2>
            <p class="mt-1 text-center text-sm text-gray-500">Select your tenant to continue</p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white px-6 py-8 shadow-sm ring-1 ring-gray-200 sm:rounded-xl sm:px-10" x-data="tenantLogin()">
                <div class="space-y-5">
                    {{-- Tenant selector --}}
                    <div>
                        <label for="tenant" class="block text-sm font-medium text-gray-700">Select Workspace</label>
                        <select x-model="selectedTenant" id="tenant" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                            <option value="">Choose a workspace...</option>
                            @foreach(\Illuminate\Support\Facades\DB::table('domains')->join('tenants', 'domains.tenant_id', '=', 'tenants.id')->select('domains.domain', 'tenants.id', 'tenants.name')->get() as $tenant)
                                <option value="{{ $tenant->domain }}">{{ $tenant->name }} ({{ $tenant->domain }}.localhost)</option>
                            @endforeach
                        </select>
                    </div>

                    <button @click="goToTenant()" :disabled="!selectedTenant"
                            class="w-full rounded-lg bg-primary-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition disabled:opacity-50 disabled:cursor-not-allowed">
                        Go to Login
                    </button>

                    <div class="relative">
                        <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-200"></div></div>
                        <div class="relative flex justify-center text-sm"><span class="bg-white px-4 text-gray-500">or enter subdomain</span></div>
                    </div>

                    {{-- Manual subdomain entry --}}
                    <div>
                        <div class="flex rounded-lg shadow-sm">
                            <input x-model="manualSubdomain" type="text" placeholder="your-company"
                                   class="block w-full rounded-l-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
                                   @keydown.enter="goToManualTenant()">
                            <span class="inline-flex items-center rounded-r-lg border border-l-0 border-gray-300 bg-gray-50 px-3 text-sm text-gray-500">.localhost:{{ request()->getPort() }}</span>
                        </div>
                    </div>

                    <button @click="goToManualTenant()" :disabled="!manualSubdomain"
                            class="w-full rounded-lg bg-gray-800 px-4 py-2.5 text-sm font-semibold text-white hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition disabled:opacity-50 disabled:cursor-not-allowed">
                        Open Workspace
                    </button>
                </div>

                <div class="mt-6 flex items-center justify-between border-t border-gray-200 pt-6">
                    <a href="{{ route('register') }}" class="text-sm font-medium text-primary-600 hover:text-primary-500">Create new workspace</a>
                    <a href="{{ route('admin.login') }}" class="text-sm font-medium text-red-600 hover:text-red-500">Admin login</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function tenantLogin() {
            return {
                selectedTenant: '',
                manualSubdomain: '',
                goToTenant() {
                    if (this.selectedTenant) {
                        window.location.href = 'http://' + this.selectedTenant + '.localhost:{{ request()->getPort() }}/login';
                    }
                },
                goToManualTenant() {
                    if (this.manualSubdomain) {
                        window.location.href = 'http://' + this.manualSubdomain.trim() + '.localhost:{{ request()->getPort() }}/login';
                    }
                }
            }
        }
    </script>
</body>
</html>
