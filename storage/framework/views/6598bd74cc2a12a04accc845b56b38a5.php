

<?php $__env->startSection('content'); ?>

<div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
    <div class="absolute top-0 right-1/4 w-96 h-96 bg-purple-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-1/3 w-96 h-96 bg-pink-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
</div>

<div class="relative z-10 space-y-6">

    
    <div class="bg-white/60 backdrop-blur-xl rounded-3xl px-6 py-5 border border-white/40 shadow-lg relative overflow-hidden group hover:shadow-indigo-100/50 transition-all duration-500">
        <div class="absolute inset-0 bg-gradient-to-r from-amber-500/5 via-orange-500/5 to-yellow-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

        <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                
                <div class="w-14 h-14 flex-shrink-0 drop-shadow-lg">
                    <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/People/Man%20Technologist.png" alt="User Icon" class="w-full h-full object-contain">
                </div>
                <div>
                    <h1 class="text-2xl font-black text-slate-800 tracking-tight">Manajemen Pengguna</h1>
                    <p class="text-slate-500 text-sm font-medium mt-0.5">Kelola akun Super Admin, Admin Unit, dan hak akses.</p>
                </div>
            </div>

            <a href="<?php echo e(route('superadmin.users.create')); ?>"
                class="group flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white rounded-xl font-bold shadow-lg hover:shadow-amber-500/30 hover:-translate-y-1 transition-all duration-300 text-sm">
                <div class="bg-white/20 p-1 rounded-lg group-hover:rotate-90 transition-transform duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <span>Tambah Pengguna</span>
            </a>
        </div>
    </div>

    
    <div class="bg-white/60 backdrop-blur-xl border border-white/40 shadow-lg rounded-2xl p-4">
        <form action="<?php echo e(route('superadmin.users.index')); ?>" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4">

            
            <div class="md:col-span-5 relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-amber-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                    class="block w-full pl-10 pr-3 py-2.5 border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-amber-500 focus:border-transparent bg-white/50 placeholder-gray-400 transition-all shadow-sm hover:bg-white"
                    placeholder="Cari nama atau email...">
            </div>

            
            <div class="md:col-span-4">
                <select name="role" class="block w-full py-2.5 px-3 border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-amber-500 focus:border-transparent bg-white/50 text-gray-600 cursor-pointer hover:bg-white transition-colors shadow-sm">
                    <option value="">-- Semua Peran --</option>
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($role->id); ?>" <?php echo e(request('role') == $role->id ? 'selected' : ''); ?>><?php echo e($role->role_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            
            <div class="md:col-span-3 flex gap-2">
                <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white rounded-xl transition-all shadow-md hover:shadow-amber-200 active:scale-95 flex items-center justify-center" title="Terapkan Filter">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                </button>
                <?php if(request()->hasany(['search', 'role'])): ?>
                <a href="<?php echo e(route('superadmin.users.index')); ?>" class="w-full bg-white hover:bg-rose-50 text-slate-400 hover:text-rose-500 border border-gray-200 rounded-xl transition-all shadow-sm flex items-center justify-center" title="Reset Filter">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    
    <div class="bg-white/60 backdrop-blur-xl border border-white/40 shadow-xl rounded-3xl overflow-hidden relative">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-amber-50/50 text-amber-900 uppercase text-xs font-bold tracking-wider border-b border-amber-100/50">
                        <th class="py-4 px-6">Identitas</th>
                        <th class="py-4 px-6">Peran & Unit</th>
                        <th class="py-4 px-6 text-center">Status</th>
                        <th class="py-4 px-6 text-center">Bergabung</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm divide-y divide-gray-100/50">
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-white/60 transition-colors duration-200 group">

                        
                        <td class="py-4 px-6 align-middle">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-slate-100 to-slate-200 border border-slate-300 flex items-center justify-center text-slate-600 font-bold shadow-sm">
                                    <?php echo e(substr($user->username, 0, 1)); ?>

                                </div>
                                <div>
                                    <p class="font-bold text-gray-800 text-sm group-hover:text-amber-600 transition-colors"><?php echo e($user->username); ?></p>
                                    <p class="text-xs text-slate-500 font-mono"><?php echo e($user->email); ?></p>
                                </div>
                            </div>
                        </td>

                        
                        <td class="py-4 px-6 align-middle">
                            <?php if($user->role->role_name == 'Superadmin'): ?>
                            <span class="inline-flex items-center gap-1.5 bg-purple-100 text-purple-700 px-2.5 py-1 rounded-lg text-xs font-bold border border-purple-200 shadow-sm mb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                Super Admin
                            </span>
                            <?php elseif($user->role->role_name == 'Admin Unit'): ?>
                            <span class="inline-flex items-center gap-1.5 bg-amber-100 text-amber-700 px-2.5 py-1 rounded-lg text-xs font-bold border border-amber-200 shadow-sm mb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                Admin Unit
                            </span>
                            <?php else: ?>
                            <span class="inline-flex items-center gap-1.5 bg-slate-100 text-slate-600 px-2.5 py-1 rounded-lg text-xs font-bold border border-slate-200 shadow-sm mb-1">
                                User
                            </span>
                            <?php endif; ?>

                            <?php if($user->unitKerja): ?>
                            <div class="text-xs text-slate-500 font-medium flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <?php echo e($user->unitKerja->unit_kerja_name); ?>

                            </div>
                            <?php endif; ?>
                        </td>

                        
                        <td class="py-4 px-6 text-center align-middle">
                            <?php if($user->is_active): ?>
                            <span class="inline-flex items-center gap-1.5 bg-emerald-100/80 text-emerald-700 px-3 py-1.5 rounded-full text-xs font-bold border border-emerald-200 shadow-sm">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                </span>
                                Aktif
                            </span>
                            <?php else: ?>
                            <span class="inline-flex items-center gap-1.5 bg-slate-100 text-slate-500 px-3 py-1.5 rounded-full text-xs font-bold border border-slate-200">
                                <span class="w-2 h-2 bg-slate-400 rounded-full"></span>
                                Non-Aktif
                            </span>
                            <?php endif; ?>
                        </td>

                        
                        <td class="py-4 px-6 text-center align-middle text-xs text-slate-500 font-medium">
                            <?php echo e($user->created_at->format('d M Y')); ?>

                        </td>

                        
                        <td class="py-4 px-6 text-center align-middle">
                            <div class="flex justify-center gap-2">
                                
                                <a href="<?php echo e(route('superadmin.users.edit', $user)); ?>" class="p-2 bg-white text-amber-600 border border-amber-100 rounded-lg hover:bg-amber-500 hover:text-white transition-all shadow-sm" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>

                                
                                <?php if(Auth::id() !== $user->id): ?>
                                <button type="button"
                                    @click="$dispatch('open-delete-modal', { url: '<?php echo e(route('superadmin.users.destroy', $user)); ?>', name: '<?php echo e(addslashes($user->username)); ?>' })"
                                    class="p-2 bg-white text-rose-600 border border-rose-100 rounded-lg hover:bg-rose-500 hover:text-white transition-all shadow-sm" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                                <?php else: ?>
                                
                                <div class="p-2 w-8 h-8"></div>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                
                                <div class="w-24 h-24 mb-4 opacity-70">
                                    <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Card%20File%20Box.png" alt="Empty" class="w-full h-full object-contain">
                                </div>
                                <h3 class="text-lg font-bold text-slate-700">Tidak ada pengguna ditemukan</h3>
                                <p class="text-slate-500 max-w-xs mx-auto mt-1 mb-6 text-sm">Coba ubah filter pencarian Anda.</p>
                                <a href="<?php echo e(route('superadmin.users.index')); ?>" class="text-amber-600 hover:text-amber-800 font-bold text-sm underline">Reset Pencarian</a>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <?php if($users->hasPages()): ?>
        <div class="bg-white/50 px-6 py-4 border-t border-gray-100 flex justify-center">
            <?php echo e($users->links()); ?>

        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\surveyZI\resources\views/superadmin/users/index.blade.php ENDPATH**/ ?>