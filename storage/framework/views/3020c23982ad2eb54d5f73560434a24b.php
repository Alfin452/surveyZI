<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title', 'value', 'subtext', 'icon', 'color' => 'indigo', 'link' => '#']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['title', 'value', 'subtext', 'icon', 'color' => 'indigo', 'link' => '#']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$colors = [
'indigo' => ['bg' => 'bg-indigo-50', 'text' => 'text-indigo-600', 'hover' => 'group-hover:text-indigo-600'],
'emerald' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'hover' => 'group-hover:text-emerald-600'],
'amber' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-600', 'hover' => 'group-hover:text-amber-600'],
'rose' => ['bg' => 'bg-rose-50', 'text' => 'text-rose-600', 'hover' => 'group-hover:text-rose-600'],
];

// Gunakan warna default jika warna yang diminta tidak ada di daftar
$c = $colors[$color] ?? $colors['indigo'];
?>

<a href="<?php echo e($link); ?>" class="group block bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
    <div class="flex items-start justify-between relative z-10">
        <div>
            <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-1"><?php echo e($title); ?></p>
            <h3 class="text-4xl font-black text-slate-800 <?php echo e($c['hover']); ?> transition-colors duration-300"><?php echo e($value); ?></h3>
            <p class="text-xs text-slate-500 mt-2 font-medium bg-slate-100 inline-block px-2 py-1 rounded-lg">
                <?php echo e($subtext); ?>

            </p>
        </div>
        <div class="p-3 rounded-2xl <?php echo e($c['bg']); ?> <?php echo e($c['text']); ?>">
            
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <?php if($icon == 'collection'): ?>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                <?php elseif($icon == 'office-building'): ?>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                <?php elseif($icon == 'users'): ?>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                <?php else: ?>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                <?php endif; ?>
            </svg>
        </div>
    </div>
    
    <div class="absolute -right-6 -bottom-6 w-24 h-24 rounded-full <?php echo e($c['bg']); ?> opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
</a><?php /**PATH C:\laragon\www\surveyZI\resources\views/components/dashboard-stat-card.blade.php ENDPATH**/ ?>