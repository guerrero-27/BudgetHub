# Fix 500 Error on Expenses Create (Railway Deployment)

## Steps:

1. ~~Create TODO.md with step list~~ (DONE)
2. ~~Create missing migration: `database/migrations/2026_03_12_000000_create_categories_table.php`~~ (DONE)
3. ~~Create missing migration: `database/migrations/2026_03_12_000001_add_category_id_to_expenses_table.php`~~ (DONE)
4. ~~Update `app/Models/Category.php` (add user_id fillable, user relation)~~ (DONE)
5. ~~Update `app/Http/Controllers/CategoryController.php` (scope to user_id)~~ (DONE)
6. ~~Update `app/Models/Expense.php` (confirm fields/relations)~~ (NO CHANGE NEEDED)
7. ~~Update `app/Http/Controllers/ExpenseController.php` (scope categories to user, safe Category::find)~~ (DONE)
8. Test locally: `php artisan migrate:fresh`, create category/expense
9. Commit and push for Railway redeploy (migrations will run)
10. Verify on Railway after deploy

**Next step: 4/10**
