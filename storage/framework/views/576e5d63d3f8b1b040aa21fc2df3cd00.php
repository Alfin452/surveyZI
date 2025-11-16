

<?php $__env->startPush('styles'); ?>
<style>
    .section-ghost {
        background: #f1f5f9;
        border: 2px dashed #94a3b8;
    }

    .question-ghost {
        background: #f1f5f9;
        border: 2px dashed #94a3b8;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-1" x-data="sectionManager(<?php echo json_encode($program->questionSections->pluck('id'), 15, 512) ?>)"
    x-init="init()"
    @open-edit-section-modal.window="showEditModal = true; editData = $event.detail"
    @open-add-section-modal.window="showAddModal = true"
    @open-delete-modal.window="openDeleteModal = true; deleteUrl = $event.detail.url; deleteItemName = $event.detail.name">

    <div x-cloak x-show="notification.show" x-transition
        class="fixed top-4 right-4 z-[100] w-full max-w-sm rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden"
        :class="{ 'bg-green-50': notification.type === 'success', 'bg-red-50': notification.type === 'error' }"
        @click.away="notification.show = false">
        <div class="p-4">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg x-show="notification.type === 'success'" class="h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <svg x-show="notification.type === 'error'" class="h-6 w-6 text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.25 11.25 0 0112 2.25c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2.25 12 2.25z" />
                    </svg>
                </div>
                <div class="ml-3 w-0 flex-1 pt-0.5">
                    <p class="text-sm font-semibold" :class="{ 'text-green-800': notification.type === 'success', 'text-red-800': notification.type === 'error' }" x-text="notification.type === 'success' ? 'Berhasil!' : 'Terjadi Kesalahan!'"></p>
                    <p class="mt-1 text-sm" :class="{ 'text-green-700': notification.type === 'success', 'text-red-700': notification.type === 'error' }" x-text="notification.message"></p>
                </div>
                <div class="ml-4 flex-shrink-0 flex">
                    <button @click="notification.show = false" class="inline-flex rounded-md p-1 focus:outline-none focus:ring-2 focus:ring-offset-2"
                        :class="{
                                'bg-green-50 text-green-500 hover:bg-green-100 focus:ring-green-600 focus:ring-offset-green-50': notification.type === 'success',
                                'bg-red-50 text-red-500 hover:bg-red-100 focus:ring-red-600 focus:ring-offset-red-50': notification.type === 'error'
                            }">
                        <span class="sr-only">Close</span>
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg p-5 border border-gray-200 shadow-sm">
        <div class="flex flex-col md:flex-row md:justify-between md:items-start">
            <div>
                <nav class="text-sm mb-2 font-medium text-gray-500" aria-label="Breadcrumb">
                    <ol class="list-none p-0 inline-flex">
                        <li class="flex items-center"><a href="<?php echo e(route('superadmin.dashboard')); ?>" class="hover:text-gray-700">Dashboard</a><span class="mx-2">/</span></li>
                        <li class="flex items-center"><a href="<?php echo e(route('superadmin.programs.index')); ?>" class="hover:text-gray-700">Program Survei</a><span class="mx-2">/</span></li>
                        <li class="flex items-center"><span class="text-gray-700">Kelola Pertanyaan</span></li>
                    </ol>
                </nav>
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0 bg-indigo-600 text-white p-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">Kelola Pertanyaan</h1>
                        <p class="text-sm text-gray-500 mt-1">Program: <span class="font-semibold"><?php echo e($program->title); ?></span></p>
                    </div>
                </div>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-2 self-start md:self-end">
                <a href="<?php echo e(route('superadmin.programs.index')); ?>" class="bg-white text-gray-700 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition border border-gray-300 shadow-sm">
                    Kembali ke Program
                </a>

                <button @click="showAddModal = true" class="bg-green-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-green-700 transition shadow-sm">
                    + Tambah Bagian Soal
                </button>

                <button type="button" x-show="isSectionOrderChanged" x-transition
                    @click="saveSectionOrder('<?php echo e(route('superadmin.programs.sections.reorder', $program)); ?>')"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition shadow-sm flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span>Simpan Urutan</span>
                </button>
            </div>
        </div>
    </div>

    <div x-ref="sectionContainer" class="space-y-6">
        <?php $__empty_1 = true; $__currentLoopData = $program->questionSections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div data-id="<?php echo e($section->id); ?>" class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="flex items-center justify-between p-4 bg-gray-50 border-b rounded-t-lg">
                <div class="flex items-center gap-3">
                    <div class="cursor-grab text-gray-400 hover:text-gray-600 handle-section" title="Geser untuk mengubah urutan bagian">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800"><?php echo e($section->title); ?></h2>
                        <p class="text-sm text-gray-500"><?php echo e($section->description); ?> (<?php echo e($section->questions_count); ?> Pertanyaan)</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <button
                        @click="$dispatch('open-edit-section-modal', <?php echo \Illuminate\Support\Js::from($section->only(['id','title','description']))->toHtml() ?>)"
                        class="text-blue-600 hover:text-blue-800"
                        title="Edit Bagian">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </button>
                    <button @click="$dispatch('open-delete-modal', { url: '<?php echo e(route('superadmin.sections.destroy', $section)); ?>', name: '<?php echo e(addslashes($section->title)); ?>' })" class="text-red-600 hover:text-red-800" title="Hapus Bagian">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="p-4 space-y-2" x-data="questionSubManager(<?php echo json_encode($section->questions->pluck('id'), 15, 512) ?>)" x-init="initQuestionSortable('<?php echo e(route('superadmin.sections.questions.reorder', $section)); ?>')">
                <div class="space-y-3" x-ref="questionContainer">
                    <?php $__empty_2 = true; $__currentLoopData = $section->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                    <div data-id="<?php echo e($question->id); ?>" x-data="{ isOptionsVisible: false }" class="list-none bg-gray-50 border rounded-lg p-3 group">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start gap-2 flex-1 min-w-0">
                                <div class="cursor-grab text-gray-400 group-hover:text-gray-600 handle-question pt-1" title="Geser untuk mengubah urutan pertanyaan">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div @click="isOptionsVisible = !isOptionsVisible" class="flex items-start justify-between cursor-pointer group/trigger pr-2">
                                        <div class="flex items-start flex-1">
                                            <span class="item-number font-semibold text-gray-800 mr-2 pt-0.5"><?php echo e($loop->iteration); ?>.</span>
                                            <p class="font-semibold text-gray-800 flex-1 pt-0.5"><?php echo e($question->question_body); ?></p>
                                        </div>
                                        <div class="text-gray-400 group-hover/trigger:text-gray-600 pl-2 pt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform" :class="{ 'rotate-180': isOptionsVisible }" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>

                                    <div x-cloak x-show="isOptionsVisible" x-transition class="flex flex-wrap gap-2 mt-3 pt-3 pl-6 border-t border-gray-200">
                                        <?php $__empty_3 = true; $__currentLoopData = $question->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_3 = false; ?>
                                        <span class="inline-flex items-center text-xs font-medium bg-gray-100 text-gray-700 px-2 py-0.5 rounded-md">
                                            <?php echo e($option->option_body); ?>

                                            <span class="font-bold text-gray-900 ml-1.5">(<?php echo e($option->option_score); ?>)</span>
                                        </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_3): ?>
                                        <span class="text-xs text-gray-400 italic">Belum ada pilihan ganda</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-start space-x-2 opacity-0 group-hover:opacity-100 transition-opacity ml-4 pt-1">
                                <a href="<?php echo e(route('superadmin.sections.questions.edit', ['section' => $section, 'question' => $question])); ?>" class="text-blue-600 hover:text-blue-800" title="Edit Pertanyaan">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <button @click="$dispatch('open-delete-modal', { url: '<?php echo e(route('superadmin.sections.questions.destroy', ['section' => $section, 'question' => $question])); ?>', name: '<?php echo e(addslashes($question->question_body)); ?>' })" class="text-red-600 hover:text-red-800" title="Hapus Pertanyaan">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                    <p class="text-sm text-gray-500 text-center py-4">Belum ada pertanyaan di bagian ini.</p>
                    <?php endif; ?>
                </div>
                <div class="flex items-center justify-between pt-3 border-t mt-4">
                    <div class="flex-1">
                        <button type="button" x-show="isQuestionOrderChanged" x-transition
                            @click="saveQuestionOrder()"
                            class="bg-blue-600 text-white px-3 py-1 rounded-lg font-medium hover:bg-blue-700 text-sm">
                            Simpan Urutan Soal
                        </button>
                    </div>
                    <a href="<?php echo e(route('superadmin.sections.questions.create', $section)); ?>" class="inline-flex items-center px-3 py-1 border border-dashed border-green-400 text-sm font-medium rounded-md text-green-700 bg-green-50 hover:bg-green-100 ml-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                        </svg>
                        Tambah Pertanyaan
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="text-center py-16 px-4 border-2 border-dashed rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
            <p class="mt-4 font-semibold text-gray-600">Belum Ada Bagian Soal</p>
            <p class="text-sm mt-1">Klik tombol "Tambah Bagian Soal" di atas untuk memulai.</p>
        </div>
        <?php endif; ?>
    </div>

    <div x-cloak x-show="showAddModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showAddModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500/75 transition-opacity" @click="showAddModal = false"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="showAddModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-lg p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
                <h3 class="text-lg font-bold leading-6 text-gray-900" id="modal-title">Tambah Bagian Soal Baru</h3>
                <form action="<?php echo e(route('superadmin.programs.sections.store', $program)); ?>" method="POST" class="mt-4 space-y-4">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label for="section_title_add" class="block text-sm font-medium text-gray-700">Judul Bagian</label>
                        <input type="text" name="title" id="section_title_add" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label for="section_desc_add" class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                        <textarea name="description" id="section_desc_add" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                    </div>
                    <div class="pt-4 flex justify-end space-x-2">
                        <button type="button" @click="showAddModal = false" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">Batal</button>
                        <button type="submit" class="bg-green-600 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-green-700">Simpan Bagian</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div x-cloak x-show="showEditModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showEditModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500/75 transition-opacity" @click="showEditModal = false"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="showEditModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-lg p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
                <h3 class="text-lg font-bold leading-6 text-gray-900" id="modal-title">Edit Bagian Soal</h3>
                <form :action="'/superadmin/sections/' + (editData ? editData.id : '')" method="POST" class="mt-4 space-y-4">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div>
                        <label for="section_title_edit" class="block text-sm font-medium text-gray-700">Judul Bagian</label>
                        <input type="text" name="title" id="section_title_edit" x-model="editData.title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label for="section_desc_edit" class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                        <textarea name="description" id="section_desc_edit" rows="3" x-model="editData.description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                    </div>
                    <div class="pt-4 flex justify-end space-x-2">
                        <button type="button" @click="showEditModal = false" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">Batal</button>
                        <button type="submit" class="bg-blue-600 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-blue-700">Perbarui Bagian</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    function sectionManager(initialOrder) {
        return {
            showEditModal: false,
            editData: {
                id: null,
                title: '',
                description: ''
            },
            showAddModal: false,
            openDeleteModal: false,
            deleteUrl: '',
            deleteItemName: '',

            notification: {
                show: false,
                message: '',
                type: 'success'
            },

            initialOrder: [...initialOrder],
            currentOrder: [...initialOrder],
            isSectionOrderChanged: false,

            init() {
                if (typeof Sortable === 'undefined') {
                    console.error('SortableJS library is not loaded.');
                    return;
                }

                new Sortable(this.$refs.sectionContainer, {
                    animation: 150,
                    handle: '.handle-section',
                    ghostClass: 'section-ghost',
                    onUpdate: () => {
                        this.currentOrder = Array.from(this.$refs.sectionContainer.children)
                            .filter(el => el.dataset.id)
                            .map(el => el.dataset.id);
                        this.isSectionOrderChanged = JSON.stringify(this.initialOrder) !== JSON.stringify(this.currentOrder);
                    }
                });
            },

            showNotification(message, type = 'success') {
                this.notification.message = message;
                this.notification.type = type;
                this.notification.show = true;
                setTimeout(() => {
                    this.notification.show = false;
                }, 3000);
            },

            saveSectionOrder(url) {
                Alpine.store('globals').isLoading = true;
                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                        },
                        body: JSON.stringify({
                            order: this.currentOrder
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            this.showNotification(data.message, 'success');
                            this.initialOrder = [...this.currentOrder];
                            this.isSectionOrderChanged = false;
                        } else {
                            this.showNotification(data.message || 'Gagal menyimpan urutan.', 'error');
                        }
                    })
                    .catch(() => this.showNotification('Terjadi error. Gagal terhubung ke server.', 'error'))
                    .finally(() => {
                        Alpine.store('globals').isLoading = false;
                    });
            }
        }
    }

    function questionSubManager(initialOrder) {
        return {
            initialOrder: [...initialOrder],
            currentOrder: [...initialOrder],
            isQuestionOrderChanged: false,
            sortableInstance: null,
            saveUrl: '',

            initQuestionSortable(url) {
                this.saveUrl = url;
                if (typeof Sortable === 'undefined') return;
                this.sortableInstance = new Sortable(this.$refs.questionContainer, {
                    animation: 150,
                    handle: '.handle-question',
                    ghostClass: 'question-ghost',
                    onUpdate: () => {
                        this.currentOrder = Array.from(this.$refs.questionContainer.children).map(el => el.dataset.id);
                        this.isQuestionOrderChanged = JSON.stringify(this.initialOrder) !== JSON.stringify(this.currentOrder);
                        this.updateNumbering();
                    }
                });
                this.updateNumbering();
            },

            updateNumbering() {
                this.$refs.questionContainer.querySelectorAll('.item-number').forEach((el, index) => {
                    el.textContent = (index + 1) + '.';
                });
            },

            saveQuestionOrder() {
                Alpine.store('globals').isLoading = true;
                fetch(this.saveUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                        },
                        body: JSON.stringify({
                            order: this.currentOrder
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            this.$dispatch('open-notification', {
                                message: data.message,
                                type: 'success'
                            });
                            this.initialOrder = [...this.currentOrder];
                            this.isQuestionOrderChanged = false;
                        } else {
                            this.$dispatch('open-notification', {
                                message: data.message || 'Gagal menyimpan urutan.',
                                type: 'error'
                            });
                        }
                    }).catch(() => {
                        this.$dispatch('open-notification', {
                            message: 'Terjadi error. Gagal terhubung ke server.',
                            type: 'error'
                        });
                    })
                    .finally(() => {
                        Alpine.store('globals').isLoading = false;
                    });
            }
        }
    }

    document.addEventListener('open-notification', (e) => {
        const manager = document.querySelector('[x-data^="sectionManager"]').__x.$data;
        if (manager) {
            manager.showNotification(e.detail.message, e.detail.type || 'success');
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\surveyZI\resources\views/superadmin/programs/questions/index.blade.php ENDPATH**/ ?>