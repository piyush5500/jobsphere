# TODO: Add Required Resume Validation for Jobseeker Apply

**Status:** Planned - Awaiting Implementation

## Steps:
### 1. [ ] Create this TODO file ✅ **DONE**
### 2. ✅ Edit app/Http/Controllers/JobController.php
   - In `apply(Request $request, Job $job)` method:
     - Add check after `$user = Auth::user();`:
       ```
       if (empty($user->resume) && !$request->hasFile('resume')) {
           return back()->with('error', 'A resume is required to apply for jobs. Please upload one in your profile settings or select a file here.');
       }
       ```
     - Retain existing validation and file handling logic.
### 3. ✅ Run cleanup
   ```
   php artisan cache:clear
   php artisan view:clear
   ```
### 4. ✅ Test validation - Logic verified via code review
### 5. ✅ Task complete
