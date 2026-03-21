# Company Dashboard Update Plan

## Task: Update Employee Dashboard as Company Dashboard

### Files Edited:
1. `resources/views/user/dashboard.blade.php` - Main dashboard view
2. `app/Http/Controllers/UserDashboardController.php` - Controller to add company-related data

### Changes Made:
1. **Terminology**: Updated welcome banner to "Manage your company, track job postings, and review applications"
2. **Stats Cards**: Added company stats (Company Jobs, Total Applications, Pending Review, Hired)
3. **Hiring Pipeline**: Added company hiring pipeline visualization
4. **Quick Actions**: Added company management actions (Post New Job, Manage Jobs, Company Profile)
5. **Sidebar**: Updated with company job performance and activity timeline
6. **Controller**: Added company-related data fetching (companyJobs, companyApplications, companyStats)
7. **Dynamic Display**: Dashboard now shows different content based on user role (company vs job seeker)

### Implementation Steps:
- [x] 1. Update UserDashboardController to include company-related data
- [x] 2. Update user/dashboard.blade.php with company-oriented UI
- [ ] 3. Test the changes

