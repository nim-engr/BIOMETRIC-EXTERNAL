<div class="row">

    <div class="col-md-4 mb-3">
        <label>Biometric Number</label>
        <input type="text" name="biometric_number"
               value="{{ old('biometric_number', $employee->biometric_number ?? '') }}"
               class="form-control" required>
    </div>

    <h5 class="mt-3">Employee Information</h5>

    <div class="col-md-4 mb-3">
        <label>First Name</label>
        <input type="text" name="first_name"
               value="{{ old('first_name', $employee->first_name ?? '') }}"
               class="form-control" required>
    </div>

    <div class="col-md-2 mb-3">
        <label>M.I.</label>
        <input type="text" name="middle_initial"
               value="{{ old('middle_initial', $employee->middle_initial ?? '') }}"
               class="form-control">
    </div>

    <div class="col-md-4 mb-3">
        <label>Family Name</label>
        <input type="text" name="family_name"
               value="{{ old('family_name', $employee->family_name ?? '') }}"
               class="form-control" required>
    </div>

    <div class="col-md-4 mb-3">
        <label>Name Extension</label>
        <input type="text" name="name_extension"
               value="{{ old('name_extension', $employee->name_extension ?? '') }}"
               class="form-control">
    </div>

    <div class="col-md-4 mb-3">
        <label>Position</label>
        <input type="text" name="position"
               value="{{ old('position', $employee->position ?? '') }}"
               class="form-control">
    </div>

    <div class="col-md-4 mb-3">
        <label>Employment Status</label>
        <input type="text" name="employment_status"
               value="{{ old('employment_status', $employee->employment_status ?? '') }}"
               class="form-control">
    </div>

    <h5 class="mt-4">Supervisor Information</h5>

    <div class="col-md-4 mb-3">
        <label>Supervisor First Name</label>
        <input type="text" name="sup_first_name"
               value="{{ old('sup_first_name', $employee->sup_first_name ?? '') }}"
               class="form-control" required>
    </div>

    <div class="col-md-2 mb-3">
        <label>M.I.</label>
        <input type="text" name="sup_middle_initial"
               value="{{ old('sup_middle_initial', $employee->sup_middle_initial ?? '') }}"
               class="form-control">
    </div>

    <div class="col-md-4 mb-3">
        <label>Supervisor Family Name</label>
        <input type="text" name="sup_family_name"
               value="{{ old('sup_family_name', $employee->sup_family_name ?? '') }}"
               class="form-control" required>
    </div>

    <div class="col-md-4 mb-3">
        <label>Name Extension</label>
        <input type="text" name="sup_name_extension"
               value="{{ old('sup_name_extension', $employee->sup_name_extension ?? '') }}"
               class="form-control">
    </div>

</div>
