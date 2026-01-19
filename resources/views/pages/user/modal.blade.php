<div class="modal fade" tabindex="-1" id="kt_modal_1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">TAMBAH DATA USER</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <form action="{{ route('user.store') }}" method="post">
                    @csrf
                    {{-- Program Studi field removed --}}
                    {{-- role --}}
                    <div class="row">
                        <div class="mb-6">
                            <label for="role" class="required form-label">Role</label>
                            <select class="form-select" name="role" data-control="select2"
                                data-placeholder="Pilih Role" data-dropdown-parent="#kt_modal_1">
                                <option></option>
                                @foreach ($role as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-6">
                            <label for="name" class="required form-label">Nama</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukan Nama User"
                                required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-6">
                            <label for="email" class="required form-label">Email</label>
                            <input type="email" name="email" class="form-control"
                                placeholder="Masukan Email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-6">
                            <label for="password" class="required form-label">Password</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="Masukan Password" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
