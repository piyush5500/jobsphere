# Performance Optimization TODO for JobSphere

## Status: [Step 1 Complete]

### Completed Steps:
- [✓] Create TODO_PERFORMANCE.md
- [✓] Create & migrate performance indexes (843ms)
- [✓] Optimize AdminController (pagination + eager load)

### 1. ✅ Indexes migration complete

### 2. ✅ AdminController optimized (paginate 20, latest(), with('job.employer'))

### 3. ✅ UserDashboardController optimized (stats 5→2 queries)

### 4. ✅ Cache Config: default 'file' + config:cache

### 5. ✅ Laravel Caching: route/view/config/optimize (routes fixed duplicate)

### 6. Verify & Test
- [ ] Check query logs/timings
- [ ] Test slow pages

### 6. Verify & Test
- [ ] Check query logs/timings
- [ ] Test slow pages
- [ ] Update this TODO with ✓

### 3. Optimize UserDashboardController  
- [ ] Consolidate company stats to single query using withCount/selectRaw
- [ ] Test /user/dashboard query count

### 4. Update Cache Config
- [ ] Change config/cache.php default to 'file'
- [ ] `php artisan config:cache`

### 5. Laravel Caching Commands
- [ ] `php artisan route:cache`
- [ ] `php artisan view:cache` 
- [ ] `php artisan config:cache`
- [ ] `php artisan optimize`

### 6. Verify & Test
- [ ] Check query logs/timings
- [ ] Test slow pages
- [ ] Update this TODO with ✓

## Commands to Run After Each Major Change:
```
php artisan route:clear
php artisan config:clear  
php artisan cache:clear
```

