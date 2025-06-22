<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::table('products')->truncate();
        DB::table('subcategories')->truncate();
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->call([
            UserSeeder::class,
        ]);

        // Seed Categories
        $categories = [
            ['id' => 1, 'product_type' => 'Пицца'],
            ['id' => 2, 'product_type' => 'Десерты'],
            ['id' => 3, 'product_type' => 'Напитки'],
            ['id' => 4, 'product_type' => 'Комбо'],
            ['id' => 5, 'product_type' => 'Закуски'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert($category);
        }

        // Seed Subcategories for all categories
        $subcategories = [
            // Пицца
            ['id' => 1, 'name' => 'Классические', 'category_id' => 1],
            ['id' => 2, 'name' => 'Острые', 'category_id' => 1],
            ['id' => 3, 'name' => 'Сырные', 'category_id' => 1],
            ['id' => 4, 'name' => 'Морские', 'category_id' => 1],
            ['id' => 5, 'name' => 'Вегетарианские', 'category_id' => 1],
            // Десерты
            ['id' => 6, 'name' => 'Чизкейки', 'category_id' => 2],
            ['id' => 7, 'name' => 'Маффины', 'category_id' => 2],
            ['id' => 8, 'name' => 'Печенье и эклеры', 'category_id' => 2],
            ['id' => 9, 'name' => 'Сырники и фондан', 'category_id' => 2],
            // Напитки
            ['id' => 10, 'name' => 'Газированные', 'category_id' => 3],
            ['id' => 11, 'name' => 'Соки', 'category_id' => 3],
            ['id' => 12, 'name' => 'Кофе и чай', 'category_id' => 3],
            // Комбо
            ['id' => 13, 'name' => 'Пицца + напиток', 'category_id' => 4],
            ['id' => 14, 'name' => 'Пиццы', 'category_id' => 4],
            ['id' => 15, 'name' => 'Десерты', 'category_id' => 4],
            ['id' => 16, 'name' => 'Закуски', 'category_id' => 4],
            // Закуски
            ['id' => 17, 'name' => 'Омлеты', 'category_id' => 5],
            ['id' => 18, 'name' => 'Сэндвичи', 'category_id' => 5],
            ['id' => 19, 'name' => 'Роллы', 'category_id' => 5],
            ['id' => 20, 'name' => 'Картофель и наггетсы', 'category_id' => 5],
        ];

        foreach ($subcategories as $subcategory) {
            DB::table('subcategories')->insert($subcategory);
        }

        // Seed Products
        $products = [
            // Пицца (пример, часть уже с subcategory_id)
            ["id"=>4,"title"=>"Острая маргарита","price"=>480,"img"=>"new1.png","product_type"=>1,"subcategory_id"=>2,"country"=>"145 г","color"=>"Горячая","qty"=>500,"description"=>"Бекон, митболы, пикантная пепперони, моцарелла, томаты, шампиньоны, сладкий перец, красный лук, чеснок, фирменный томатный соус","created_at"=>"2023-02-21 10:59:21","updated_at"=>null],
            ["id"=>5,"title"=>"Гавайская","price"=>450,"img"=>"slider1.jpeg","product_type"=>1,"subcategory_id"=>1,"country"=>"190 г","color"=>"Горячая","qty"=>200,"description"=>"Томатный соус, моцарелла, ветчина, ананасы, кукуруза, красный лук","created_at"=>"2023-04-21 10:59:21","updated_at"=>"2025-02-13 22:05:10"],
            ["id"=>6,"title"=>"4 сезона","price"=>529,"img"=>"new2.png","product_type"=>1,"subcategory_id"=>1,"country"=>"180 г","color"=>"Горячая","qty"=>2000,"description"=>"Томатный соус, моцарелла, ветчина, грибы, артишоки, оливки, перец, томаты","created_at"=>"2023-02-21 10:59:21","updated_at"=>"2024-12-11 12:00:11"],
            ["id"=>8,"title"=>"Мексиканская","price"=>589,"img"=>"2.png","product_type"=>1,"subcategory_id"=>2,"country"=>"170 г","color"=>"Горячая","qty"=>10,"description"=>"Томатный соус, моцарелла, пепперони, перец халапеньо, кукуруза, красный лук, чили","created_at"=>null,"updated_at"=>null],
            ["id"=>9,"title"=>"Сицилийская","price"=>609,"img"=>"4.png","product_type"=>1,"subcategory_id"=>1,"country"=>"175 г","color"=>"Горячая","qty"=>10,"description"=>"Томатный соус, моцарелла, анчоусы, каперсы, оливки, базилик","created_at"=>null,"updated_at"=>null],
            ["id"=>11,"title"=>"Сырная","price"=>329,"img"=>"5.png","product_type"=>1,"subcategory_id"=>3,"country"=>"300 г","color"=>"Горячая","qty"=>10,"description"=>"Сырный соус, моцарелла, чеддер, пармезан, горгонзола","created_at"=>null,"updated_at"=>null],
            ["id"=>12,"title"=>"Барбекю","price"=>329,"img"=>"6.png","product_type"=>1,"subcategory_id"=>2,"country"=>"165 г","color"=>"Горячая","qty"=>10,"description"=>"Соус барбекю, моцарелла, куриное филе, бекон, красный лук, перец","created_at"=>null,"updated_at"=>null],
            ["id"=>13,"title"=>"Диабло","price"=>329,"img"=>"7.png","product_type"=>1,"subcategory_id"=>2,"country"=>"160 г","color"=>"Горячая","qty"=>10,"description"=>"Острый томатный соус, моцарелла, пепперони, перец халапеньо, чили, чеснок","created_at"=>null,"updated_at"=>null],
            // Десерты
            ["id"=>14,"title"=>"Чизкейк с кокосом","price"=>150,"img"=>"desert.png","product_type"=>2,"subcategory_id"=>6,"country"=>"120 г","color"=>"Холодная","qty"=>10,"description"=>"Творожный сыр, сливки, сахар, кокосовая стружка, песочное печенье, ваниль","created_at"=>null,"updated_at"=>null],
            ["id"=>15,"title"=>"Чизкейк","price"=>150,"img"=>"desert1.png","product_type"=>2,"subcategory_id"=>6,"country"=>"120 г","color"=>"Холодная","qty"=>10,"description"=>"Творожный сыр, сливки, сахар, песочное печенье, ваниль, лимонный сок","created_at"=>null,"updated_at"=>null],
            ["id"=>16,"title"=>"Фондан","price"=>170,"img"=>"desert2.png","product_type"=>2,"subcategory_id"=>9,"country"=>"100 г","color"=>"Горячая","qty"=>10,"description"=>"Темный шоколад, сливочное масло, сахар, яйца, мука, какао-порошок","created_at"=>null,"updated_at"=>null],
            ["id"=>17,"title"=>"Сырники с сгущенкой","price"=>130,"img"=>"desert3.png","product_type"=>2,"subcategory_id"=>9,"country"=>"150 г","color"=>"Горячая","qty"=>10,"description"=>"Творог, яйца, сахар, мука, сгущенное молоко, ваниль","created_at"=>null,"updated_at"=>null],
            ["id"=>18,"title"=>"Сорбет клубничный","price"=>135,"img"=>"desert4.png","product_type"=>2,"subcategory_id"=>null,"country"=>"100 г","color"=>"Холодная","qty"=>10,"description"=>"Клубника, сахар, лимонный сок, вода","created_at"=>null,"updated_at"=>null],
            ["id"=>19,"title"=>"Сырники","price"=>130,"img"=>"desert5.png","product_type"=>2,"subcategory_id"=>9,"country"=>"150 г","color"=>"Горячая","qty"=>10,"description"=>"Творог, яйца, сахар, мука, ваниль, соль","created_at"=>null,"updated_at"=>null],
            ["id"=>20,"title"=>"Маффин соленная карамель","price"=>110,"img"=>"desert6.png","product_type"=>2,"subcategory_id"=>7,"country"=>"100 г","color"=>"Горячая","qty"=>10,"description"=>"Мука, сахар, яйца, сливочное масло, молоко, карамельный соус, соль","created_at"=>null,"updated_at"=>null],
            ["id"=>21,"title"=>"Маффин три шоколада","price"=>110,"img"=>"desert7.png","product_type"=>2,"subcategory_id"=>7,"country"=>"100 г","color"=>"Горячая","qty"=>10,"description"=>"Мука, сахар, яйца, сливочное масло, молоко, темный шоколад, белый шоколад, молочный шоколад","created_at"=>null,"updated_at"=>null],
            ["id"=>22,"title"=>"Печенье шоколадное","price"=>90,"img"=>"desert8.png","product_type"=>2,"subcategory_id"=>8,"country"=>"80 г","color"=>"Холодная","qty"=>10,"description"=>"Мука, сахар, сливочное масло, яйца, какао-порошок, шоколадная крошка","created_at"=>null,"updated_at"=>null],
            ["id"=>23,"title"=>"Эклеры","price"=>120,"img"=>"desert9.png","product_type"=>2,"subcategory_id"=>8,"country"=>"90 г","color"=>"Холодная","qty"=>10,"description"=>"Заварное тесто, заварной крем, шоколадная глазурь","created_at"=>null,"updated_at"=>null],
            // Напитки
            ["id"=>24,"title"=>"Кола добрый","price"=>125,"img"=>"drink.png","product_type"=>3,"subcategory_id"=>10,"country"=>"500 мл","color"=>"Холодная","qty"=>10,"description"=>"Газированная вода, сахар, карамельный краситель, ортофосфорная кислота, натуральные ароматизаторы, кофеин","created_at"=>null,"updated_at"=>null],
            ["id"=>25,"title"=>"Кола добрый без сахара","price"=>125,"img"=>"drink1.png","product_type"=>3,"subcategory_id"=>10,"country"=>"500 мл","color"=>"Холодная","qty"=>10,"description"=>"Газированная вода, аспартам, ацесульфам калия, карамельный краситель, ортофосфорная кислота, натуральные ароматизаторы, кофеин","created_at"=>null,"updated_at"=>null],
            ["id"=>26,"title"=>"Добрый апельсин","price"=>125,"img"=>"drink2.png","product_type"=>3,"subcategory_id"=>11,"country"=>"500 мл","color"=>"Холодная","qty"=>10,"description"=>"Газированная вода, сахар, апельсиновый сок, лимонная кислота, натуральные ароматизаторы, витамин C","created_at"=>null,"updated_at"=>null],
            ["id"=>27,"title"=>"Добрый лимон-лайм","price"=>125,"img"=>"drink3.png","product_type"=>3,"subcategory_id"=>10,"country"=>"500 мл","color"=>"Холодная","qty"=>10,"description"=>"Газированная вода, сахар, лимонный сок, лаймовый сок, лимонная кислота, натуральные ароматизаторы","created_at"=>null,"updated_at"=>null],
            ["id"=>28,"title"=>"Рич Ти зеленый","price"=>115,"img"=>"drink4.png","product_type"=>3,"subcategory_id"=>12,"country"=>"500 мл","color"=>"Холодная","qty"=>10,"description"=>"Зеленый чай, вода, сахар, лимонная кислота, натуральные ароматизаторы, витамины","created_at"=>null,"updated_at"=>null],
            ["id"=>29,"title"=>"Бон аква без газа","price"=>90,"img"=>"drink5.png","product_type"=>3,"subcategory_id"=>null,"country"=>"500 мл","color"=>"Холодная","qty"=>10,"description"=>"Очищенная питьевая вода","created_at"=>null,"updated_at"=>null],
            ["id"=>30,"title"=>"Рич сок яблочный","price"=>140,"img"=>"drink6.png","product_type"=>3,"subcategory_id"=>11,"country"=>"500 мл","color"=>"Холодная","qty"=>10,"description"=>"Яблочный сок, витамин C","created_at"=>null,"updated_at"=>null],
            ["id"=>31,"title"=>"Рич сок вишневый","price"=>140,"img"=>"drink7.png","product_type"=>3,"subcategory_id"=>11,"country"=>"500 мл","color"=>"Холодная","qty"=>10,"description"=>"Вишневый сок, витамин C","created_at"=>null,"updated_at"=>null],
            ["id"=>32,"title"=>"Кофе американо","price"=>105,"img"=>"drink8.png","product_type"=>3,"subcategory_id"=>12,"country"=>"300 мл","color"=>"Горячая","qty"=>10,"description"=>"Эспрессо, горячая вода","created_at"=>null,"updated_at"=>null],
            ["id"=>33,"title"=>"Кофе капучино","price"=>105,"img"=>"drink9.png","product_type"=>3,"subcategory_id"=>12,"country"=>"300 мл","color"=>"Горячая","qty"=>10,"description"=>"Эспрессо, взбитое молоко, молочная пена","created_at"=>null,"updated_at"=>null],
            // Комбо
            ["id"=>34,"title"=>"2 пиццы+напиток","price"=>899,"img"=>"combo.png","product_type"=>4,"subcategory_id"=>13,"country"=>"2x180 г + 500 мл","color"=>"Горячая/Холодная","qty"=>10,"description"=>"Две пиццы на выбор + напиток на выбор","created_at"=>null,"updated_at"=>null],
            ["id"=>35,"title"=>"5 пицц","price"=>2899,"img"=>"combo1.png","product_type"=>4,"subcategory_id"=>14,"country"=>"5x180 г","color"=>"Горячая","qty"=>10,"description"=>"Пять пицц на выбор","created_at"=>null,"updated_at"=>null],
            ["id"=>36,"title"=>"7 пицц","price"=>3899,"img"=>"combo2.png","product_type"=>4,"subcategory_id"=>14,"country"=>"7x180 г","color"=>"Горячая","qty"=>10,"description"=>"Семь пицц на выбор","created_at"=>null,"updated_at"=>null],
            ["id"=>38,"title"=>"2 десерта","price"=>200,"img"=>"combo4.png","product_type"=>4,"subcategory_id"=>15,"country"=>"2x120 г","color"=>"Холодная","qty"=>10,"description"=>"Два десерта на выбор","created_at"=>null,"updated_at"=>null],
            ["id"=>39,"title"=>"2 закуски","price"=>400,"img"=>"combo5.png","product_type"=>4,"subcategory_id"=>16,"country"=>"2x150 г","color"=>"Горячая","qty"=>10,"description"=>"Две закуски на выбор","created_at"=>null,"updated_at"=>null],
            // Закуски
            ["id"=>44,"title"=>"Омлет грибной","price"=>179,"img"=>"zakuski.png","product_type"=>5,"subcategory_id"=>17,"country"=>"150 г","color"=>"Горячая","qty"=>10,"description"=>"Яйца, молоко, шампиньоны, лук, сливочное масло, соль, перец","created_at"=>null,"updated_at"=>null],
            ["id"=>45,"title"=>"Омлет барбекю","price"=>179,"img"=>"zakuski1.png","product_type"=>5,"subcategory_id"=>17,"country"=>"150 г","color"=>"Горячая","qty"=>10,"description"=>"Яйца, молоко, соус барбекю, куриное филе, лук, перец, соль","created_at"=>null,"updated_at"=>null],
            ["id"=>46,"title"=>"Омлет пепперони","price"=>179,"img"=>"zakuski2.png","product_type"=>5,"subcategory_id"=>17,"country"=>"150 г","color"=>"Горячая","qty"=>10,"description"=>"Яйца, молоко, пепперони, моцарелла, томаты, базилик, соль","created_at"=>null,"updated_at"=>null],
            ["id"=>47,"title"=>"Сэндвич с беконом","price"=>199,"img"=>"zakuski3.png","product_type"=>5,"subcategory_id"=>18,"country"=>"200 г","color"=>"Горячая","qty"=>10,"description"=>"Булочка, бекон, листья салата, томаты, майонез, горчица","created_at"=>null,"updated_at"=>null],
            ["id"=>48,"title"=>"Сэндвич овощной","price"=>199,"img"=>"zakuski4.png","product_type"=>5,"subcategory_id"=>18,"country"=>"200 г","color"=>"Холодная","qty"=>10,"description"=>"Булочка, листья салата, томаты, огурец, перец, авокадо, хумус","created_at"=>null,"updated_at"=>null],
            ["id"=>49,"title"=>"Ролл с ветчиной","price"=>159,"img"=>"zakuski5.png","product_type"=>5,"subcategory_id"=>19,"country"=>"150 г","color"=>"Холодная","qty"=>10,"description"=>"Лаваш, ветчина, сыр, листья салата, томаты, майонез","created_at"=>null,"updated_at"=>null],
            ["id"=>50,"title"=>"Ролл","price"=>159,"img"=>"zakuski6.png","product_type"=>5,"subcategory_id"=>19,"country"=>"150 г","color"=>"Холодная","qty"=>10,"description"=>"Лаваш, куриное филе, листья салата, томаты, майонез","created_at"=>null,"updated_at"=>null],
            ["id"=>51,"title"=>"Наггетсы","price"=>159,"img"=>"zakuski7.png","product_type"=>5,"subcategory_id"=>20,"country"=>"150 г","color"=>"Горячая","qty"=>10,"description"=>"Куриное филе, панировочные сухари, яйца, специи, соус на выбор","created_at"=>null,"updated_at"=>null],
            ["id"=>52,"title"=>"Картофель с соусом","price"=>109,"img"=>"zakuski8.png","product_type"=>5,"subcategory_id"=>20,"country"=>"150 г","color"=>"Горячая","qty"=>10,"description"=>"Картофель фри, соус на выбор","created_at"=>null,"updated_at"=>null],
        ];

        DB::table('products')->insert($products);
    }
}
