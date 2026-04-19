# TODO: Fix Admin Manage Users Pages Consistency & Ascending Order ✅

## Approved Plan Steps:
- [x] **Step 1**: Update controllers for ascending order (`orderBy('id', 'asc')` instead of `latest()`) ✅
  - `app/Http/Controllers/AdminDashboardController.php` (users, jobseekers) ✅
  - `app/Http/Controllers/EmployeeController.php` (index) ✅
- [x] **Step 2**: Modernize companies page design `resources/views/admin/employees/index.blade.php` to match users/jobseekers style (purple theme) ✅
- [ ] **Step 3**: Clear caches
- [ ] **Step 4**: Test all 3 pages
- [ ] **Complete**

**Current Progress**: Steps 1-2 complete
