<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="icon" type="image/png" href="<?php echo e(asset('assets/img/logo.jpeg')); ?>">

    <title>China boutique | Sign In</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { inter: ['Inter','ui-sans-serif','system-ui'] },
                    colors: {
                        hobby: {
                            50:  '#F1F3FC',
                            100: '#E5E9FA',
                            200: '#CFD5F6',
                            300: '#B2BAEF',
                            400: '#9397E6',
                            500: '#817FDD',
                            600: '#6A5ECD',
                            700: '#5A4EB4',
                            800: '#494291',
                            900: '#3F3B74',
                            950: '#252244',
                            lime: '#D6EA64',
                            alab: '#F5F0E6'
                        }
                    },
                    boxShadow: {
                        soft: '0 20px 60px rgba(37,34,68,.16)',
                        glow: '0 0 0 6px rgba(129,127,221,.10)'
                    }
                }
            }
        }
    </script>

    <style>
        /* Page entrance */
        @keyframes fadeUp { from{opacity:0; transform:translateY(18px) scale(.99)} to{opacity:1; transform:translateY(0) scale(1)} }
        .anim-fadeup { animation: fadeUp .7s ease-out both; }

        /* Floating blobs */
        @keyframes float1 { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-18px)} }
        @keyframes float2 { 0%,100%{transform:translateY(0)} 50%{transform:translateY(18px)} }
        .float-1 { animation: float1 7s ease-in-out infinite; }
        .float-2 { animation: float2 8s ease-in-out infinite; }

        /* Button shine */
        @keyframes shine { 0%{transform:translateX(-140%)} 100%{transform:translateX(140%)} }
        .btn-shine::after{
            content:'';
            position:absolute; inset:-2px;
            background: linear-gradient(110deg, transparent 0%, rgba(255,255,255,.22) 50%, transparent 100%);
            transform: translateX(-140%);
            animation: shine 4.2s ease-in-out infinite;
            pointer-events:none;
        }

        /* Reduced motion */
        @media (prefers-reduced-motion: reduce){
            .anim-fadeup, .float-1, .float-2, .btn-shine::after { animation: none !important; }
        }
    </style>
</head>

<body class="font-inter bg-hobby-alab text-hobby-950 overflow-hidden">
<main class="h-screen relative overflow-hidden flex items-center justify-center px-4">

    
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-24 -left-28 w-[520px] h-[520px] rounded-full blur-3xl opacity-25 bg-hobby-400 float-1"></div>
        <div class="absolute -bottom-28 -right-28 w-[560px] h-[560px] rounded-full blur-3xl opacity-25 bg-hobby-lime float-2"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[900px] h-[420px] rounded-[90px] blur-3xl opacity-10 bg-hobby-700"></div>
    </div>

    
    <section class="relative w-full max-w-md anim-fadeup">
        <div class="rounded-3xl bg-white/80 backdrop-blur-xl border border-white/60 shadow-soft overflow-hidden
                    transition duration-300 hover:-translate-y-1 hover:shadow-glow">

            
            <div class="p-6 sm:p-7 border-b border-hobby-100">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-hobby-50 border border-hobby-100 flex items-center justify-center">
                        <img src="<?php echo e(asset('assets/img/logo.jpeg')); ?>"
                             alt="Hobby Logo"
                             class="w-10 h-10 rounded-xl object-cover">
                    </div>
                    <div>
                        <h1 class="text-3xl font-extrabold text-hobby-950 leading-tight">Welcome back</h1>
                        <p class="text-sm text-hobby-900/70 mt-1">Sign in to continue your journey.</p>
                    </div>
                </div>

                <?php if($alert = Session::get('alert-success')): ?>
                    <div class="mt-4 rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-amber-900 text-sm">
                        <?php echo e($alert); ?>

                    </div>
                <?php endif; ?>
            </div>

            
            <div class="p-6 sm:p-7">
                <form method="POST" action="<?php echo e(route('admin.login.post')); ?>" class="space-y-4">
                    <?php echo csrf_field(); ?>

                    
                    <div>
                        <label class="block text-sm font-bold text-hobby-950 mb-2">Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-hobby-900/45">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                    <path d="M4 6h16v12H4V6Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                    <path d="m4 7 8 6 8-6" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <input
                                name="email"
                                id="email"
                                type="email"
                                value="<?php echo e(old('email')); ?>"
                                placeholder="name@example.com"
                                class="w-full rounded-2xl bg-white border border-hobby-200 pl-11 pr-4 py-3
                                       text-hobby-950 placeholder:text-hobby-900/35
                                       focus:outline-none focus:ring-4 focus:ring-hobby-200/60 focus:border-hobby-400
                                       transition duration-200
                                       <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 focus:ring-red-200/60 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            >
                        </div>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div>
                        <label class="block text-sm font-bold text-hobby-950 mb-2">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-hobby-900/45">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                    <path d="M7 11V8a5 5 0 0 1 10 0v3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M6 11h12v10H6V11Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <input
                                name="password"
                                id="password"
                                type="password"
                                placeholder="••••••••"
                                class="w-full rounded-2xl bg-white border border-hobby-200 pl-11 pr-4 py-3
                                       text-hobby-950 placeholder:text-hobby-900/35
                                       focus:outline-none focus:ring-4 focus:ring-hobby-200/60 focus:border-hobby-400
                                       transition duration-200
                                       <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 focus:ring-red-200/60 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            >
                            <input type="hidden" name="remember" id="remember">
                        </div>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="flex items-center gap-2">
                        <input type="checkbox"
                               class="w-4 h-4 rounded border-hobby-300 text-hobby-700 focus:ring-hobby-200">
                        <span class="text-sm text-hobby-900/80 select-none">Remember me</span>
                    </div>

                    
                    <button type="submit"
                            class="btn-shine group relative w-full overflow-hidden rounded-2xl px-4 py-3.5
                                   font-extrabold text-white
                                   bg-gradient-to-r from-hobby-700 via-hobby-600 to-hobby-500
                                   shadow-soft hover:opacity-95 active:scale-[0.99]
                                   focus:outline-none focus:ring-4 focus:ring-hobby-200/70
                                   transition duration-200">
                        <span class="relative z-10 inline-flex items-center justify-center gap-2">
                            Sign In
                            <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24" fill="none">
                                <path d="M5 12h12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <path d="m13 6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </button>

                    <p class="text-xs text-center text-hobby-900/55 leading-relaxed">
                        By continuing, you agree to our platform policies.
                    </p>

                    
                    <p class="pt-1 text-center text-[11px] text-hobby-900/50">
                        © <?php echo e(date('Y')); ?> China boutique — All rights reserved.
                    </p>
                </form>
            </div>
        </div>
    </section>

</main>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\china\resources\views/auth/login.blade.php ENDPATH**/ ?>