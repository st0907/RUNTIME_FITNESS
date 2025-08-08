/*
Programmer Name : Siew Zhen Lynn (TP076386)
Program Name    : DP.PS.FoodDB.js
Description     : Food Database for Personalized Diet Plan
First Written on: Sunday, 15-June-2025
Edited on: 05-July-2025
*/

const FoodDB = {
    // Food categories with nutritional info and constraints
    foods: [
        // BREAKFAST ITEMS
        {
            name: "Scrambled Eggs",
            mealType:  ["breakfast", "lunch"] ,
            calories: 180,
            protein: 14,
            carbs: 2,
            fat: 12,
            price: 2.50,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Eggs", quantity: "2-3 eggs", notes: "Free-range if possible" },
                { item: "Salt and Pepper", quantity: "To taste", notes: "For seasoning" },
                { item: "Olive Oil or Butter", quantity: "1 tsp", notes: "For cooking" }
            ],
            cookingInstructions: [
                "Crack eggs into a bowl and beat until well mixed",
                "Heat a non-stick pan over medium heat",
                "Add oil or butter to the pan",
                "Pour eggs into the pan and gently stir until cooked to desired consistency",
                "Season with salt and pepper"
            ]
        },
        {
            name: "Overnight Oats",
            mealType: ["breakfast", "snack", "dinner"],
            calories: 320,
            protein: 12,
            carbs: 50,
            fat: 8,
            price: 3.20,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true, 
                glutenFree: true, 
                keto: false
            },
            groceryList: [
                { item: "Oats", quantity: "1/2 cup", notes: "Rolled oats, gluten-free if needed" },
                { item: "Plant Milk", quantity: "1/2 cup", notes: "Almond, soy, or oat milk" },
                { item: "Chia Seeds", quantity: "1 tbsp", notes: "For added nutrition" },
                { item: "Fresh Fruits", quantity: "1/4 cup", notes: "Berries, banana, or other fruits" },
                { item: "Honey or Maple Syrup", quantity: "1 tsp", notes: "Optional sweetener" }
            ],
            cookingInstructions: [
                "Combine oats, milk, and chia seeds in a jar",
                "Stir well to mix ingredients",
                "Refrigerate overnight or at least 4 hours",
                "In the morning, top with fresh fruits and honey or maple syrup if desired"
            ]
        },
        {
            name: "Avocado Toast",
            mealType: ["breakfast", "dinner", "snack"],
            calories: 260,
            protein: 8,
            carbs: 30,
            fat: 15,
            price: 4.50,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: false, // Using regular bread
                keto: false
            },
            groceryList: [
                { item: "Bread", quantity: "2 slices", notes: "Whole grain or gluten-free if needed" },
                { item: "Avocado", quantity: "1/2", notes: "Ripe avocado" },
                { item: "Lemon", quantity: "1/4", notes: "For juice" },
                { item: "Salt and Pepper", quantity: "To taste", notes: "For seasoning" },
                { item: "Red Pepper Flakes", quantity: "Pinch", notes: "Optional for spice" }
            ],
            cookingInstructions: [
                "Toast bread until golden and crisp",
                "Cut avocado in half, remove pit, and scoop out flesh",
                "Mash avocado in a bowl with a fork",
                "Add lemon juice, salt, and pepper",
                "Spread mashed avocado on toast",
                "Top with red pepper flakes if desired"
            ]
        },
        {
            name: "Greek Yogurt with Berries",
            mealType: ["breakfast","lunch", "dinner", "snack"],
            calories: 200,
            protein: 18,
            carbs: 15,
            fat: 8, 
            price: 4.00,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: true,
                dairyFree: false,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Greek Yogurt", quantity: "1 cup", notes: "Plain, unflavored" },
                { item: "Mixed Berries", quantity: "1/2 cup", notes: "Fresh or frozen" },
                { item: "Honey", quantity: "1 tsp", notes: "Optional, for sweetness" },
                { item: "Nuts", quantity: "1 tbsp", notes: "Optional, for added crunch" }
            ],
            cookingInstructions: [
                "Place Greek yogurt in a bowl",
                "Top with mixed berries",
                "Drizzle with honey if desired",
                "Sprinkle with nuts for added texture"
            ]
        },
        {
            name: "Tofu Scramble",
            mealType: ["breakfast", "lunch", "dinner"],
            calories: 200,
            protein: 16,
            carbs: 10,
            fat: 12,
            price: 3.80,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Firm Tofu", quantity: "200g", notes: "Drained and pressed" },
                { item: "Turmeric", quantity: "1/4 tsp", notes: "For color" },
                { item: "Nutritional Yeast", quantity: "1 tbsp", notes: "For flavor" },
                { item: "Bell Pepper", quantity: "1/2", notes: "Diced" },
                { item: "Spinach", quantity: "Handful", notes: "Fresh" },
                { item: "Olive Oil", quantity: "1 tsp", notes: "For cooking" }
            ],
            cookingInstructions: [
                "Crumble tofu into a bowl",
                "Heat oil in a pan over medium heat",
                "Add diced bell pepper and cook until softened",
                "Add crumbled tofu, turmeric, and nutritional yeast",
                "Cook for 5 minutes, stirring occasionally",
                "Add spinach and cook until wilted",
                "Season with salt and pepper"
            ]
        },
        {
            name: "Keto Bowl",
            mealType: ["breakfast", "dinner"],
            calories: 450,
            protein: 25,
            carbs: 5,
            fat: 35,
            price: 6.50,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: false,
                dairyFree: false,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Bacon", quantity: "2 strips", notes: "Cooked crispy" },
                { item: "Avocado", quantity: "1/2", notes: "Sliced" },
                { item: "Eggs", quantity: "2", notes: "Fried or poached" },
                { item: "Spinach", quantity: "1 cup", notes: "Sautéed" },
                { item: "Cheddar Cheese", quantity: "2 tbsp", notes: "Shredded" }
            ],
            cookingInstructions: [
                "Cook bacon until crispy, then set aside",
                "Sauté spinach in bacon fat until wilted",
                "Fry or poach eggs as desired",
                "Assemble bowl with spinach on bottom",
                "Top with eggs, sliced avocado, crumbled bacon, and shredded cheese"
            ]
        },
        {
            name: "Pancakes",
            mealType: ["breakfast", "snack"],
            calories: 310,
            protein: 9,
            carbs: 58,
            fat: 7,
            price: 4.20,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: false,
                keto: false
            },
            groceryList: [
                { item: "Flour", quantity: "1 cup", notes: "All-purpose or gluten-free" },
                { item: "Plant Milk", quantity: "1 cup", notes: "Almond, soy, or oat" },
                { item: "Baking Powder", quantity: "1 tsp", notes: "" },
                { item: "Maple Syrup", quantity: "1 tbsp", notes: "For serving" }
            ],
            cookingInstructions: [
                "Mix flour, baking powder, and plant milk to form batter",
                "Cook pancakes on a non-stick pan until golden",
                "Serve with maple syrup"
            ]
        },
        {
            name: "Omelette",
            mealType: ["breakfast", "snack"],
            calories: 350,
            protein: 20,
            carbs: 3,
            fat: 28,
            price: 5.00,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: true,
                dairyFree: false,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Eggs", quantity: "3", notes: "" },
                { item: "Cheese", quantity: "1/4 cup", notes: "Shredded" },
                { item: "Spinach", quantity: "1/2 cup", notes: "Fresh" }
            ],
            cookingInstructions: [
                "Beat eggs and pour into a hot pan",
                "Add cheese and spinach",
                "Fold and cook until set"
            ]
        },
        {
            name: "Vegetarian Burrito",
            mealType: ["breakfast", "lunch", "dinner"],
            calories: 400,
            protein: 16,
            carbs: 55,
            fat: 12,
            price: 4.80,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: true,
                dairyFree: false,
                glutenFree: false,
                keto: false
            },
            groceryList: [
                { item: "Tortilla", quantity: "1", notes: "Whole wheat" },
                { item: "Eggs", quantity: "2", notes: "Scrambled" },
                { item: "Bell Pepper", quantity: "1/4 cup", notes: "Diced" },
                { item: "Cheese", quantity: "2 tbsp", notes: "Shredded" }
            ],
            cookingInstructions: [
                "Scramble eggs with bell pepper",
                "Fill tortilla with eggs and cheese",
                "Roll up and serve"
            ]
        },
        {
            name: "Chia Pudding",
            mealType: ["breakfast", "snack"],
            calories: 250,
            protein: 6,
            carbs: 35,
            fat: 10,
            price: 3.60,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Chia Seeds", quantity: "3 tbsp", notes: "" },
                { item: "Coconut Milk", quantity: "1 cup", notes: "" },
                { item: "Berries", quantity: "1/4 cup", notes: "Fresh or frozen" }
            ],
            cookingInstructions: [
                "Mix chia seeds and coconut milk",
                "Refrigerate overnight",
                "Top with berries before serving"
            ]
        },
        {
            name: "Banana Muffins",
            mealType: ["breakfast", "snack"],
            calories: 220,
            protein: 5,
            carbs: 38,
            fat: 7,
            price: 3.10,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Gluten-Free Flour", quantity: "1 cup", notes: "" },
                { item: "Banana", quantity: "1", notes: "Mashed" },
                { item: "Egg", quantity: "1", notes: "" },
                { item: "Coconut Oil", quantity: "2 tbsp", notes: "" }
            ],
            cookingInstructions: [
                "Mix all ingredients to form batter",
                "Pour into muffin tins",
                "Bake at 180°C for 20 minutes"
            ]
        },
        {
            name: "French Toast",
            mealType: ["breakfast", "dinner", "snack"],
            calories: 330,
            protein: 10,
            carbs: 45,
            fat: 12,
            price: 3.90,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: true,
                dairyFree: false,
                glutenFree: false,
                keto: false
            },
            groceryList: [
                { item: "Bread", quantity: "2 slices", notes: "" },
                { item: "Egg", quantity: "1", notes: "Beaten" },
                { item: "Milk", quantity: "1/4 cup", notes: "" },
                { item: "Cinnamon", quantity: "1/2 tsp", notes: "" }
            ],
            cookingInstructions: [
                "Dip bread in egg and milk mixture",
                "Cook on skillet until golden brown",
                "Sprinkle with cinnamon"
            ]
        },
        {
            name: "Berry Smoothie Bowl",
            mealType: ["breakfast", "lunch", "snack"],
            calories: 280,
            protein: 7,
            carbs: 50,
            fat: 6,
            price: 4.10,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Mixed Berries", quantity: "1 cup", notes: "Frozen" },
                { item: "Banana", quantity: "1/2", notes: "" },
                { item: "Almond Milk", quantity: "1/2 cup", notes: "" },
                { item: "Granola", quantity: "1/4 cup", notes: "Gluten-free if needed" }
            ],
            cookingInstructions: [
                "Blend berries, banana, and almond milk",
                "Pour into bowl and top with granola"
            ]
        },
        
        {
            name: "Grilled Chicken Salad",
            mealType: ["lunch", "dinner", "snack"],
            calories: 320,
            protein: 28,
            carbs: 12,
            fat: 16,
            price: 8.50,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: false,
                dairyFree: true,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Chicken Breast", quantity: "150g", notes: "Boneless, skinless" },
                { item: "Mixed Greens", quantity: "2 cups", notes: "Fresh, washed" },
                { item: "Cherry Tomatoes", quantity: "5-6", notes: "Halved" },
                { item: "Cucumber", quantity: "1/4", notes: "Sliced" },
                { item: "Olive Oil", quantity: "1 tbsp", notes: "For dressing" },
                { item: "Lemon", quantity: "1/4", notes: "For juice" }
            ],
            cookingInstructions: [
                "Season chicken breast with salt, pepper, and herbs",
                "Grill or pan-fry until fully cooked (internal temperature of 165°F)",
                "Let chicken rest, then slice",
                "Combine mixed greens, tomatoes, and cucumber in a bowl",
                "Top with sliced chicken",
                "Whisk olive oil and lemon juice for dressing",
                "Drizzle dressing over salad before serving"
            ]
        },
        {
            name: "Quinoa Bowl",
            mealType: ["lunch", "dinner"],
            calories: 380,
            protein: 15,
            carbs: 50,
            fat: 12,
            price: 7.80,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Quinoa", quantity: "1/2 cup", notes: "Uncooked" },
                { item: "Chickpeas", quantity: "1/2 cup", notes: "Canned, drained" },
                { item: "Roasted Vegetables", quantity: "1 cup", notes: "Bell peppers, zucchini, etc." },
                { item: "Avocado", quantity: "1/4", notes: "Sliced" },
                { item: "Lemon", quantity: "1/4", notes: "For juice" },
                { item: "Olive Oil", quantity: "1 tbsp", notes: "For dressing" }
            ],
            cookingInstructions: [
                "Cook quinoa according to package instructions",
                "Roast vegetables tossed in olive oil at 400°F for 20 minutes",
                "Combine cooked quinoa, chickpeas, and roasted vegetables in a bowl",
                "Top with sliced avocado",
                "Drizzle with olive oil and lemon juice",
                "Season with salt and pepper to taste"
            ]
        },
        {
            name: "Tuna Salad Wrap",
            mealType: ["lunch","breakfast", "dinner"],
            calories: 350,
            protein: 24,
            carbs: 30,
            fat: 14,
            price: 6.70,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: false,
                dairyFree: true,
                glutenFree: false, 
                keto: false
            },
            groceryList: [
                { item: "Tuna", quantity: "1 can (120g)", notes: "Canned in water, drained" },
                { item: "Mayonnaise", quantity: "1 tbsp", notes: "Regular or light" },
                { item: "Celery", quantity: "1 stalk", notes: "Finely chopped" },
                { item: "Red Onion", quantity: "1 tbsp", notes: "Finely chopped" },
                { item: "Whole Wheat Tortilla", quantity: "1", notes: "Large size" },
                { item: "Mixed Greens", quantity: "Handful", notes: "For filling" }
            ],
            cookingInstructions: [
                "Mix tuna, mayonnaise, celery, and red onion in a bowl",
                "Season with salt, pepper, and a squeeze of lemon",
                "Lay out tortilla and add mixed greens",
                "Spread tuna mixture on top of greens",
                "Roll up the tortilla tightly, tucking in the sides",
                "Cut in half diagonally to serve"
            ]
        },
        {
            name: "Mediterranean Lentil Bowl",
            mealType: ["lunch", "dinner"],
            calories: 400,
            protein: 18,
            carbs: 60,
            fat: 10,
            price: 5.90,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Green or Brown Lentils", quantity: "1/2 cup", notes: "Uncooked" },
                { item: "Cucumber", quantity: "1/4", notes: "Diced" },
                { item: "Cherry Tomatoes", quantity: "5-6", notes: "Halved" },
                { item: "Red Onion", quantity: "2 tbsp", notes: "Finely chopped" },
                { item: "Parsley", quantity: "2 tbsp", notes: "Chopped" },
                { item: "Olive Oil", quantity: "1 tbsp", notes: "For dressing" },
                { item: "Lemon", quantity: "1/4", notes: "For juice" }
            ],
            cookingInstructions: [
                "Cook lentils according to package instructions",
                "Combine cooked lentils, cucumber, tomatoes, red onion, and parsley",
                "Whisk together olive oil, lemon juice, salt, and pepper",
                "Drizzle dressing over lentil mixture and toss gently",
                "Serve at room temperature or chilled"
            ]
        },
        
        {
            name: "Grilled Salmon",
            mealType: ["breakfast", "lunch", "dinner"],
            calories: 350,
            protein: 34,
            carbs: 0,
            fat: 22,
            price: 12.50,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: false,
                dairyFree: true,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Salmon Fillet", quantity: "150g", notes: "Fresh or defrosted" },
                { item: "Lemon", quantity: "1/2", notes: "Sliced" },
                { item: "Garlic", quantity: "2 cloves", notes: "Minced" },
                { item: "Dill", quantity: "1 tbsp", notes: "Fresh, chopped" },
                { item: "Olive Oil", quantity: "1 tbsp", notes: "For cooking" }
            ],
            cookingInstructions: [
                "Preheat grill or oven to 400°F",
                "Mix olive oil, garlic, and dill in a small bowl",
                "Brush salmon with the oil mixture",
                "Place lemon slices on top of salmon",
                "Grill or bake for 12-15 minutes until salmon flakes easily",
                "Serve with additional lemon wedges if desired"
            ]
        },
        {
            name: "Chickpea Curry",
            mealType: ["lunch", "dinner"],
            calories: 380,
            protein: 15,
            carbs: 45,
            fat: 16,
            price: 6.20,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Chickpeas", quantity: "1 can (400g)", notes: "Drained and rinsed" },
                { item: "Coconut Milk", quantity: "200ml", notes: "Full-fat or light" },
                { item: "Tomatoes", quantity: "2 medium", notes: "Chopped" },
                { item: "Onion", quantity: "1/2", notes: "Chopped" },
                { item: "Garlic", quantity: "2 cloves", notes: "Minced" },
                { item: "Curry Powder", quantity: "2 tsp", notes: "Or curry paste" },
                { item: "Spinach", quantity: "2 cups", notes: "Fresh" }
            ],
            cookingInstructions: [
                "Sauté onion in oil until translucent",
                "Add garlic and cook for 30 seconds",
                "Add curry powder and stir for 1 minute",
                "Add tomatoes and cook until softened",
                "Add chickpeas and coconut milk, simmer for 10 minutes",
                "Stir in spinach until wilted",
                "Season with salt to taste",
                "Serve with rice or naan bread (optional)"
            ]
        },
        {
            name: "Beef Stir Fry",
            mealType: ["lunch", "dinner"],
            calories: 420,
            protein: 30,
            carbs: 25,
            fat: 20,    
            price: 9.80,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: false,
                dairyFree: true,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Beef Sirloin", quantity: "150g", notes: "Thinly sliced" },
                { item: "Bell Peppers", quantity: "1", notes: "Sliced" },
                { item: "Broccoli", quantity: "1 cup", notes: "Florets" },
                { item: "Carrots", quantity: "1", notes: "Julienned" },
                { item: "Soy Sauce", quantity: "2 tbsp", notes: "Low-sodium" },
                { item: "Garlic", quantity: "2 cloves", notes: "Minced" },
                { item: "Ginger", quantity: "1 tsp", notes: "Grated" },
                { item: "Sesame Oil", quantity: "1 tsp", notes: "For flavor" }
            ],
            cookingInstructions: [
                "Marinate beef slices in half of the soy sauce for 15 minutes",
                "Heat oil in a wok or large pan over high heat",
                "Cook beef until browned, then remove from pan",
                "In the same pan, stir-fry garlic and ginger for 30 seconds",
                "Add vegetables and stir-fry until crisp-tender",
                "Return beef to the pan",
                "Add remaining soy sauce and sesame oil",
                "Stir to combine and cook for another minute",
                "Serve hot, optionally over rice"
            ]
        },
        {
            name: "Pasta",
            mealType: ["lunch", "dinner"],
            calories: 450,
            protein: 14,
            carbs: 65,
            fat: 15,
            price: 7.50,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: false, 
                keto: false
            },
            groceryList: [
                { item: "Pasta", quantity: "80g", notes: "Dry weight" },
                { item: "Zucchini", quantity: "1/2", notes: "Sliced" },
                { item: "Bell Peppers", quantity: "1/2", notes: "Diced" },
                { item: "Cherry Tomatoes", quantity: "10", notes: "Halved" },
                { item: "Garlic", quantity: "2 cloves", notes: "Minced" },
                { item: "Olive Oil", quantity: "2 tbsp", notes: "For cooking and dressing" },
                { item: "Basil", quantity: "2 tbsp", notes: "Fresh, torn" }
            ],
            cookingInstructions: [
                "Cook pasta according to package instructions",
                "Heat olive oil in a pan over medium heat",
                "Sauté garlic until fragrant",
                "Add zucchini and bell peppers, cook until softened",
                "Add cherry tomatoes and cook for 2 minutes",
                "Drain pasta and add to the pan with vegetables",
                "Toss everything together with additional olive oil if needed",
                "Garnish with fresh basil before serving"
            ]
        },
        
        {
            name: "Mixed Nuts",
            mealType: "snack",
            calories: 170,
            protein: 5,
            carbs: 7,
            fat: 15,
            price: 3.50,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Almonds", quantity: "10g", notes: "Raw or roasted, unsalted" },
                { item: "Walnuts", quantity: "10g", notes: "Raw or roasted, unsalted" },
                { item: "Cashews", quantity: "10g", notes: "Raw or roasted, unsalted" }
            ],
            cookingInstructions: [
                "Combine equal parts of almonds, walnuts, and cashews",
                "Store in an airtight container",
                "Portion out 30g serving when ready to eat"
            ]
        },
        {
            name: "Apple with Almond Butter",
            mealType: "snack",
            calories: 200,
            protein: 5,
            carbs: 25,
            fat: 10,
            price: 2.80,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: false  
            },
            groceryList: [
                { item: "Apple", quantity: "1 medium", notes: "Any variety" },
                { item: "Almond Butter", quantity: "1 tbsp", notes: "No added sugar" }
            ],
            cookingInstructions: [
                "Wash and slice the apple",
                "Serve with almond butter for dipping"
            ]
        },
        {
            name: "Greek Yogurt with Honey",
            mealType: ["breakfast", "snack"],
            calories: 150,
            protein: 15,
            carbs: 12,
            fat: 3,
            price: 2.50,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: true,
                dairyFree: false,
                glutenFree: true,
                keto: false  // Higher carb content due to honey
            },
            groceryList: [
                { item: "Greek Yogurt", quantity: "150g", notes: "Plain, unflavored" },
                { item: "Honey", quantity: "1 tsp", notes: "Raw honey if possible" }
            ],
            cookingInstructions: [
                "Place Greek yogurt in a bowl",
                "Drizzle with honey",
                "Optional: add a sprinkle of cinnamon or a few berries"
            ]
        },
        {
            name: "Hummus with Veggie Sticks",
            mealType: ["breakfast", "snack"],
            calories: 180,
            protein: 6,
            carbs: 20,
            fat: 8,
            price: 3.20,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Hummus", quantity: "3 tbsp", notes: "Store-bought or homemade" },
                { item: "Carrot", quantity: "1 medium", notes: "Cut into sticks" },
                { item: "Celery", quantity: "2 stalks", notes: "Cut into sticks" },
                { item: "Bell Pepper", quantity: "1/4", notes: "Cut into strips" }
            ],
            cookingInstructions: [
                "Wash and cut vegetables into sticks/strips",
                "Serve with hummus for dipping"
            ]
        },
        {
            name: "Buddha Bowl",
            mealType: ["lunch", "dinner"],
            calories: 420,
            protein: 14,
            carbs: 65,
            fat: 12,
            price: 7.20,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Brown Rice", quantity: "1/2 cup", notes: "Cooked" },
                { item: "Chickpeas", quantity: "1/2 cup", notes: "Canned, drained" },
                { item: "Roasted Sweet Potato", quantity: "1/2 cup", notes: "Cubed" },
                { item: "Spinach", quantity: "1 cup", notes: "Fresh" },
                { item: "Tahini", quantity: "1 tbsp", notes: "For dressing" }
            ],
            cookingInstructions: [
                "Arrange rice, chickpeas, sweet potato, and spinach in a bowl",
                "Drizzle with tahini and serve"
            ]
        },
        {
            name: "Chicken Caesar Salad",
            mealType: ["lunch", "dinner"],
            calories: 390,
            protein: 32,
            carbs: 6,
            fat: 25,
            price: 8.90,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: false,
                dairyFree: false,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Chicken Breast", quantity: "120g", notes: "Grilled" },
                { item: "Romaine Lettuce", quantity: "2 cups", notes: "Chopped" },
                { item: "Parmesan Cheese", quantity: "2 tbsp", notes: "Shredded" },
                { item: "Caesar Dressing", quantity: "2 tbsp", notes: "Low-carb" }
            ],
            cookingInstructions: [
                "Toss lettuce with dressing",
                "Top with grilled chicken and parmesan"
            ]
        },
        {
            name: "Caprese Sandwich",
            mealType: ["breakfast", "dinner"],
            calories: 410,
            protein: 15,
            carbs: 48,
            fat: 16,
            price: 6.10,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: false,
                glutenFree: false,
                keto: false
            },
            groceryList: [
                { item: "Ciabatta Bread", quantity: "1 roll", notes: "" },
                { item: "Mozzarella", quantity: "2 slices", notes: "Fresh" },
                { item: "Tomato", quantity: "2 slices", notes: "" },
                { item: "Basil", quantity: "4 leaves", notes: "Fresh" },
                { item: "Olive Oil", quantity: "1 tsp", notes: "" }
            ],
            cookingInstructions: [
                "Layer mozzarella, tomato, and basil on bread",
                "Drizzle with olive oil and serve"
            ]
        },
        {
            name: "Lentil Soup",
            mealType: ["snack", "dinner"],
            calories: 340,
            protein: 13,
            carbs: 55,
            fat: 6,
            price: 5.40,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Lentils", quantity: "1/2 cup", notes: "Dried" },
                { item: "Carrot", quantity: "1/2 cup", notes: "Diced" },
                { item: "Celery", quantity: "1/4 cup", notes: "Diced" },
                { item: "Onion", quantity: "1/4 cup", notes: "Diced" },
                { item: "Vegetable Broth", quantity: "2 cups", notes: "" }
            ],
            cookingInstructions: [
                "Simmer all ingredients until lentils are soft",
                "Season to taste and serve"
            ]
        },
        {
            name: "Turkey Wrap",
            mealType: ["breakfast", "dinner"],
            calories: 360,
            protein: 22,
            carbs: 28,
            fat: 14,
            price: 7.00,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: false,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Gluten-Free Tortilla", quantity: "1", notes: "Large size" },
                { item: "Turkey Breast", quantity: "80g", notes: "Sliced" },
                { item: "Avocado", quantity: "1/4", notes: "Mashed" },
                { item: "Mixed Greens", quantity: "Handful", notes: "Fresh" },
                { item: "Cucumber", quantity: "1/4", notes: "Sliced" }
            ],
            cookingInstructions: [
                "Lay out tortilla and spread mashed avocado",
                "Layer turkey, greens, and cucumber",
                "Roll up tightly and cut in half"
            ]
        },
        {
            name: "Chicken Rice Bowl",
            mealType: ["lunch", "dinner"],
            calories: 480,
            protein: 28,
            carbs: 60,
            fat: 12,
            price: 8.20,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: false,
                dairyFree: false,
                glutenFree: false,
                keto: false
            },
            groceryList: [
                { item: "Rice", quantity: "1 cup", notes: "Cooked" },
                { item: "Chicken Breast", quantity: "100g", notes: "Grilled" },
                { item: "Broccoli", quantity: "1/2 cup", notes: "Steamed" },
                { item: "Soy Sauce", quantity: "1 tbsp", notes: "" }
            ],
            cookingInstructions: [
                "Arrange rice, chicken, and broccoli in a bowl",
                "Drizzle with soy sauce and serve"
            ]
        },
        {
            name: "Quinoa Salad",
            mealType: ["breakfast", "dinner"],
            calories: 370,
            protein: 11,
            carbs: 60,
            fat: 9, 
            price: 6.80,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Quinoa", quantity: "1/2 cup", notes: "Cooked" },
                { item: "Cucumber", quantity: "1/4 cup", notes: "Diced" },
                { item: "Tomato", quantity: "1/4 cup", notes: "Diced" },
                { item: "Lemon Juice", quantity: "1 tbsp", notes: "" },
                { item: "Olive Oil", quantity: "1 tbsp", notes: "" }
            ],
            cookingInstructions: [
                "Mix all ingredients in a bowl",
                "Chill and serve"
            ]
        },
        {
            name: "Vegan Stir Fry",
            mealType: ["lunch", "dinner"],
            calories: 390,
            protein: 13,
            carbs: 60,
            fat: 10,
            price: 7.10,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: false,
                glutenFree: false,
                keto: false
            },
            groceryList: [
                { item: "Tofu", quantity: "100g", notes: "Cubed" },
                { item: "Broccoli", quantity: "1 cup", notes: "Florets" },
                { item: "Carrot", quantity: "1/2 cup", notes: "Sliced" },
                { item: "Soy Sauce", quantity: "1 tbsp", notes: "" },
                { item: "Rice", quantity: "1/2 cup", notes: "Cooked" }
            ],
            cookingInstructions: [
                "Stir fry tofu and vegetables",
                "Add soy sauce and serve over rice"
            ]
        },
        {
            name: "Salmon with Asparagus",
            mealType: ["lunch", "dinner"],
            calories: 420,
            protein: 32,
            carbs: 4,
            fat: 30,
            price: 13.00,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: false,
                dairyFree: true,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Salmon Fillet", quantity: "120g", notes: "" },
                { item: "Asparagus", quantity: "1 cup", notes: "Trimmed" },
                { item: "Olive Oil", quantity: "1 tbsp", notes: "" }
            ],
            cookingInstructions: [
                "Roast salmon and asparagus with olive oil",
                "Serve together"
            ]
        },
        {
            name: "Vegetarian Lasagna",
            mealType: ["lunch", "dinner"],
            calories: 480,
            protein: 18,
            carbs: 65,
            fat: 16,
            price: 9.20,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: false,
                glutenFree: false,
                keto: false
            },
            groceryList: [
                { item: "Lasagna Noodles", quantity: "2 sheets", notes: "" },
                { item: "Ricotta Cheese", quantity: "1/4 cup", notes: "" },
                { item: "Spinach", quantity: "1/2 cup", notes: "" },
                { item: "Tomato Sauce", quantity: "1/4 cup", notes: "" }
            ],
            cookingInstructions: [
                "Layer noodles, cheese, spinach, and sauce",
                "Bake until bubbly"
            ]
        },
        {
            name: "Chickpea Stew",
            mealType: ["lunch", "dinner"],
            calories: 370,
            protein: 12,
            carbs: 55,
            fat: 9,
            price: 6.40,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Chickpeas", quantity: "1 cup", notes: "Canned, drained" },
                { item: "Tomato", quantity: "1/2 cup", notes: "Diced" },
                { item: "Carrot", quantity: "1/2 cup", notes: "Diced" },
                { item: "Spinach", quantity: "1 cup", notes: "Fresh" }
            ],
            cookingInstructions: [
                "Simmer all ingredients until thickened",
                "Serve hot"
            ]
        },
        {
            name: "Chicken Stir Fry",
            mealType: ["lunch", "dinner"],
            calories: 410,
            protein: 28,
            carbs: 35,
            fat: 14,
            price: 8.80,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: false,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Chicken Breast", quantity: "100g", notes: "Sliced" },
                { item: "Bell Pepper", quantity: "1/2 cup", notes: "Sliced" },
                { item: "Broccoli", quantity: "1/2 cup", notes: "Florets" },
                { item: "Gluten-Free Soy Sauce", quantity: "1 tbsp", notes: "" }
            ],
            cookingInstructions: [
                "Stir fry chicken and vegetables",
                "Add soy sauce and serve"
            ]
        },
        {
            name: "Beef Stew",
            mealType: ["lunch", "dinner"],
            calories: 520,
            protein: 32,
            carbs: 40,
            fat: 22,
            price: 10.50,
            dietaryRestrictions: { //only for Regular
                vegan: false,
                vegetarian: false,
                dairyFree: false,
                glutenFree: false,
                keto: false
            },
            groceryList: [
                { item: "Beef", quantity: "120g", notes: "Cubed" },
                { item: "Potato", quantity: "1/2 cup", notes: "Diced" },
                { item: "Carrot", quantity: "1/2 cup", notes: "Diced" },
                { item: "Onion", quantity: "1/4 cup", notes: "Diced" }
            ],
            cookingInstructions: [
                "Simmer beef and vegetables until tender",
                "Serve hot"
            ]
        },
        {
            name: "Vegetable Curry",
            mealType: ["lunch", "dinner"],
            calories: 390,
            protein: 10,
            carbs: 60,
            fat: 12,
            price: 7.30,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Mixed Vegetables", quantity: "1 cup", notes: "Chopped" },
                { item: "Coconut Milk", quantity: "1/2 cup", notes: "" },
                { item: "Curry Powder", quantity: "1 tbsp", notes: "" },
                { item: "Rice", quantity: "1/2 cup", notes: "Cooked" }
            ],
            cookingInstructions: [
                "Cook vegetables with curry powder and coconut milk",
                "Serve over rice"
            ]
        },
        {
            name: "Energy Balls",
            mealType: ["snack"],
            calories: 120,
            protein: 3,
            carbs: 18,
            fat: 5,
            price: 2.20,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Oats", quantity: "1/2 cup", notes: "Gluten-free if needed" },
                { item: "Peanut Butter", quantity: "2 tbsp", notes: "" },
                { item: "Maple Syrup", quantity: "1 tbsp", notes: "" },
                { item: "Cocoa Powder", quantity: "1 tbsp", notes: "" }
            ],
            cookingInstructions: [
                "Mix all ingredients, roll into balls, chill before serving"
            ]
        },
        {
            name: "Cheese Crisps",
            mealType: ["snack"],
            calories: 150,
            protein: 9,
            carbs: 1,
            fat: 12,
            sodium: 320,
            cholesterol: 30,
            price: 2.80,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: true,
                dairyFree: false,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Cheese", quantity: "1/2 cup", notes: "Shredded" }
            ],
            cookingInstructions: [
                "Bake cheese in small piles until crispy"
            ]
        },
        {
            name: "Fruit Granola",
            mealType: ["breakfast", "lunch", "snack"],
            calories: 180,
            protein: 6,
            carbs: 32,
            fat: 4,
            sodium: 45,
            cholesterol: 15,
            price: 3.00,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: true,
                dairyFree: false,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Yogurt", quantity: "1/2 cup", notes: "" },
                { item: "Mixed Fruit", quantity: "1/2 cup", notes: "" },
                { item: "Granola", quantity: "2 tbsp", notes: "Gluten-free if needed" }
            ],
            cookingInstructions: [
                "Layer yogurt, fruit, and granola in a cup"
            ]
        },
        {
            name: "Apple Chips",
            mealType: ["snack"],
            calories: 90,
            protein: 0,
            carbs: 24,
            fat: 0,
            sodium: 2,
            cholesterol: 0,
            price: 2.10,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Apple", quantity: "1", notes: "Sliced thin" },
                { item: "Cinnamon", quantity: "1/2 tsp", notes: "" }
            ],
            cookingInstructions: [
                "Bake apple slices with cinnamon until crisp"
            ]
        },
        {
            name: "Nut Bars",
            mealType: ["snack"],
            calories: 160,
            protein: 4,
            carbs: 18,
            fat: 8,
            sodium: 35,
            cholesterol: 0,
            price: 2.90,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Mixed Nuts", quantity: "1/4 cup", notes: "" },
                { item: "Honey", quantity: "1 tbsp", notes: "" },
                { item: "Oats", quantity: "1/4 cup", notes: "Gluten-free if needed" }
            ],
            cookingInstructions: [
                "Mix and bake until set, cut into bars"
            ]
        },
        {
            name: "Trail Mix",
            mealType: ["snack"],
            calories: 140,
            protein: 3,
            carbs: 16,
            fat: 7,
            sodium: 5,
            cholesterol: 0,
            price: 2.60,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Raisins", quantity: "2 tbsp", notes: "" },
                { item: "Pumpkin Seeds", quantity: "2 tbsp", notes: "" },
                { item: "Sunflower Seeds", quantity: "2 tbsp", notes: "" }
            ],
            cookingInstructions: [
                "Mix all ingredients and serve"
            ]
        },
        {
            name: "Lentil Shepherd Pie",
            mealType: ["lunch", "dinner"],
            calories: 450,
            protein: 18,
            carbs: 60,
            fat: 15,
            sodium: 380,
            cholesterol: 0,
            price: 8.50,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Lentils", quantity: "1 cup", notes: "Cooked" },
                { item: "Mixed Vegetables", quantity: "1 cup", notes: "Peas, carrots, corn" },
                { item: "Sweet Potato", quantity: "2 medium", notes: "For topping" },
                { item: "Onion", quantity: "1", notes: "Diced" }
            ],
            cookingInstructions: [
                "Sauté onion and vegetables, add lentils and vegetable broth, simmer until thick.",
                "Top with mashed sweet potato and bake at 180°C for 25 minutes."
            ]
        },
        {
            name: "Vegan Black Bean Burgers",
            mealType: ["lunch", "dinner"],
            calories: 380,
            protein: 15,
            carbs: 45,
            fat: 12,
            sodium: 420,
            cholesterol: 0,
            price: 7.20,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: false,
                keto: false
            },
            groceryList: [
                { item: "Black Beans", quantity: "1 can", notes: "Mashed" },
                { item: "Breadcrumbs", quantity: "1/2 cup", notes: "" },
                { item: "Onion", quantity: "1/2", notes: "Finely chopped" },
                { item: "Spices", quantity: "To taste", notes: "Cumin, chili powder" }
            ],
            cookingInstructions: [
                "Mix all ingredients, form into patties, and pan-fry until golden brown."
            ]
        },
        {
            name: "Creamy Tomato Pasta",
            mealType: ["lunch", "dinner"],
            calories: 480,
            protein: 12,
            carbs: 70,
            fat: 15,
            sodium: 520,
            cholesterol: 0,
            price: 9.00,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: false,
                keto: false
            },
            groceryList: [
                { item: "Pasta", quantity: "100g", notes: "" },
                { item: "Cashews", quantity: "1/2 cup", notes: "Soaked, for cream sauce" },
                { item: "Tomato Sauce", quantity: "1 cup", notes: "" },
                { item: "Garlic", quantity: "2 cloves", notes: "Minced" }
            ],
            cookingInstructions: [
                "Blend soaked cashews with water to make a cream.",
                "Sauté garlic, add tomato sauce and cashew cream, simmer.",
                "Toss with cooked pasta."
            ]
        },
        {
            name: "Chickpea and Spinach Curry",
            mealType: ["lunch", "dinner"],
            calories: 420,
            protein: 16,
            carbs: 55,
            fat: 14,
            sodium: 480,
            cholesterol: 0,
            price: 7.80,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Chickpeas", quantity: "1 can", notes: "" },
                { item: "Spinach", quantity: "2 cups", notes: "" },
                { item: "Coconut Milk", quantity: "1 can", notes: "" },
                { item: "Curry Powder", quantity: "2 tsp", notes: "" }
            ],
            cookingInstructions: [
                "Sauté onions and garlic, add curry powder, coconut milk, and chickpeas.",
                "Simmer for 15 minutes, then stir in spinach until wilted."
            ]
        },
        {
            name: "Tofu and Vegetable Skewers",
            mealType: ["lunch", "dinner"],
            calories: 320,
            protein: 20,
            carbs: 25,
            fat: 15,
            sodium: 580,
            cholesterol: 0,
            price: 8.00,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Firm Tofu", quantity: "200g", notes: "Cubed" },
                { item: "Bell Peppers", quantity: "1", notes: "Chopped" },
                { item: "Zucchini", quantity: "1", notes: "Chopped" },
                { item: "Soy Sauce", quantity: "2 tbsp", notes: "For marinade" }
            ],
            cookingInstructions: [
                "Marinate tofu in soy sauce, then thread onto skewers with vegetables.",
                "Grill or bake until tofu is golden and vegetables are tender."
            ]
        },
        {
            name: "Mushroom Risotto",
            mealType: ["lunch", "dinner"],
            calories: 450,
            protein: 12,
            carbs: 70,
            fat: 12,
            sodium: 420,
            cholesterol: 0,
            price: 9.50,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Arborio Rice", quantity: "1 cup", notes: "" },
                { item: "Mushrooms", quantity: "2 cups", notes: "Sliced" },
                { item: "Vegetable Broth", quantity: "4 cups", notes: "" },
                { item: "Nutritional Yeast", quantity: "2 tbsp", notes: "" }
            ],
            cookingInstructions: [
                "Sauté mushrooms, then add rice and toast lightly.",
                "Gradually add vegetable broth, stirring until absorbed.",
                "Stir in nutritional yeast at the end."
            ]
        },
        {
            name: "Sweet Potato and Kale Bowl",
            mealType: ["lunch", "dinner"],
            calories: 380,
            protein: 10,
            carbs: 50,
            fat: 14,
            sodium: 35,
            cholesterol: 0,
            price: 7.00,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Sweet Potato", quantity: "1 large", notes: "Roasted and cubed" },
                { item: "Kale", quantity: "2 cups", notes: "Massaged with lemon juice" },
                { item: "Quinoa", quantity: "1/2 cup", notes: "Cooked" },
                { item: "Tahini Dressing", quantity: "2 tbsp", notes: "" }
            ],
            cookingInstructions: [
                "Combine all ingredients in a bowl and toss to combine."
            ]
        },
        {
            name: "Cauliflower Tacos",
            mealType: ["lunch", "dinner"],
            calories: 350,
            protein: 10,
            carbs: 40,
            fat: 15,
            sodium: 380,
            cholesterol: 0,
            price: 7.50,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Cauliflower", quantity: "1 head", notes: "Cut into florets" },
                { item: "Taco Shells", quantity: "3", notes: "Corn or gluten-free" },
                { item: "Avocado", quantity: "1/2", notes: "Sliced" },
                { item: "Spices", quantity: "To taste", notes: "Chili powder, cumin" }
            ],
            cookingInstructions: [
                "Toss cauliflower with spices and roast until tender.",
                "Serve in taco shells with avocado and other toppings."
            ]
        },
        {
            name: "Cocoa Avocado Mousse",
            mealType: ["breakfast", "snack"],
            calories: 250,
            protein: 5,
            carbs: 20,
            fat: 18,
            sodium: 15,
            cholesterol: 0,
            price: 4.50,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Avocado", quantity: "1", notes: "Ripe" },
                { item: "Cocoa Powder", quantity: "1/4 cup", notes: "" },
                { item: "Maple Syrup", quantity: "2 tbsp", notes: "" },
                { item: "Plant Milk", quantity: "2 tbsp", notes: "" }
            ],
            cookingInstructions: [
                "Blend all ingredients until smooth and creamy. Chill before serving."
            ]
        },
        {
            name: "Coconut Yogurt Parfait",
            mealType: ["breakfast", "snack"],
            calories: 300,
            protein: 8,
            carbs: 35,
            fat: 15,
            sodium: 25,
            cholesterol: 0,
            price: 5.00,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Coconut Yogurt", quantity: "1 cup", notes: "" },
                { item: "Granola", quantity: "1/4 cup", notes: "Gluten-free if needed" },
                { item: "Berries", quantity: "1/2 cup", notes: "" }
            ],
            cookingInstructions: [
                "Layer coconut yogurt, granola, and berries in a glass."
            ]
        },
        {
            name: "Chicken Rice Casserole",
            mealType: ["lunch", "dinner"],
            calories: 450,
            protein: 25,
            carbs: 50,
            fat: 15,
            sodium: 680,
            cholesterol: 65,
            price: 9.00,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: false,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Chicken Breast", quantity: "150g", notes: "Cooked and shredded" },
                { item: "Brown Rice", quantity: "1 cup", notes: "Cooked" },
                { item: "Dairy-Free Cream of Mushroom Soup", quantity: "1 can", notes: "" },
                { item: "Mixed Vegetables", quantity: "1 cup", notes: "" }
            ],
            cookingInstructions: [
                "Mix all ingredients in a baking dish and bake at 180°C for 20-25 minutes."
            ]
        },
        {
            name: "Salmon with Roasted Veggies",
            mealType: ["lunch", "dinner"],
            calories: 420,
            protein: 30,
            carbs: 20,
            fat: 22,
            sodium: 280,
            cholesterol: 85,
            price: 12.00,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: false,
                dairyFree: true,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Salmon Fillet", quantity: "150g", notes: "" },
                { item: "Broccoli", quantity: "1 cup", notes: "" },
                { item: "Bell Peppers", quantity: "1 cup", notes: "" },
                { item: "Olive Oil", quantity: "1 tbsp", notes: "" }
            ],
            cookingInstructions: [
                "Toss vegetables in olive oil and roast at 200°C for 15 minutes.",
                "Add salmon and roast for another 12-15 minutes."
            ]
        },
        {
            name: "Banana Bread",
            mealType: ["breakfast", "snack"],
            calories: 280,
            protein: 5,
            carbs: 45,
            fat: 10,
            price: 4.00,
            dietaryRestrictions: {
                vegan: true,    
                vegetarian: true,
                dairyFree: true,
                glutenFree: false,
                keto: false
            },
            groceryList: [
                { item: "Bananas", quantity: "3", notes: "Ripe and mashed" },
                { item: "Flour", quantity: "1.5 cups", notes: "" },
                { item: "Coconut Oil", quantity: "1/3 cup", notes: "Melted" },
                { item: "Sugar", quantity: "1/2 cup", notes: "" }
            ],
            cookingInstructions: [
                "Mix all ingredients, pour into a loaf pan, and bake at 175°C for 50-60 minutes."
            ]
        },
        {
            name: "Potato Leek Soup",
            mealType: ["snack", "dinner"],
            calories: 300,
            protein: 8,
            carbs: 40,
            fat: 12,
            price: 6.50,
            dietaryRestrictions: {
                vegan: true,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: false
            },
            groceryList: [
                { item: "Potatoes", quantity: "3 medium", notes: "Peeled and chopped" },
                { item: "Leeks", quantity: "2 large", notes: "Cleaned and sliced" },
                { item: "Vegetable Broth", quantity: "4 cups", notes: "" },
                { item: "Coconut Cream", quantity: "1/4 cup", notes: "" }
            ],
            cookingInstructions: [
                "Sauté leeks, add potatoes and broth, and simmer until potatoes are tender.",
                "Blend until smooth and stir in coconut cream."
            ]
        },
        {
            name: "Avocado and Bacon Salad",
            mealType: ["breakfast", "lunch", "dinner"],
            calories: 450,
            protein: 15,
            carbs: 10,
            fat: 40,    
            price: 8.00,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: false,
                dairyFree: true,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Avocado", quantity: "1", notes: "Cubed" },
                { item: "Bacon", quantity: "4 slices", notes: "Cooked and crumbled" },
                { item: "Mixed Greens", quantity: "2 cups", notes: "" },
                { item: "Olive Oil Vinaigrette", quantity: "2 tbsp", notes: "" }
            ],
            cookingInstructions: [
                "Combine all ingredients in a bowl and toss gently."
            ]
        },
        {
            name: "Steak Cauliflower Mash",
            mealType: ["lunch", "dinner"],
            calories: 550,
            protein: 40,
            carbs: 12,
            fat: 38,
            price: 15.00,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: false,
                dairyFree: false,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Steak", quantity: "200g", notes: "Ribeye or sirloin" },
                { item: "Cauliflower", quantity: "1/2 head", notes: "" },
                { item: "Butter", quantity: "2 tbsp", notes: "" },
                { item: "Heavy Cream", quantity: "2 tbsp", notes: "" }
            ],
            cookingInstructions: [
                "Cook steak to desired doneness.",
                "Steam cauliflower until tender, then blend with butter and cream until smooth."
            ]
        },
        {
            name: "Pesto Zucchini Noodles",
            mealType: ["lunch", "dinner"],
            calories: 350,
            protein: 10,
            carbs: 15,
            fat: 30,
            price: 9.00,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: true,
                dairyFree: false,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Zucchini", quantity: "2", notes: "Spiralized" },
                { item: "Pesto", quantity: "1/4 cup", notes: "" },
                { item: "Cherry Tomatoes", quantity: "1/2 cup", notes: "Halved" },
                { item: "Parmesan Cheese", quantity: "2 tbsp", notes: "" }
            ],
            cookingInstructions: [
                "Sauté zucchini noodles for 2-3 minutes.",
                "Toss with pesto, tomatoes, and parmesan."
            ]
        },
        {
            name: "Fat Bombs",
            mealType: ["snack"],
            calories: 150,
            protein: 2,
            carbs: 2,
            fat: 15,
            price: 3.00,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: true,
                dairyFree: false,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Cream Cheese", quantity: "1/4 cup", notes: "" },
                { item: "Peanut Butter", quantity: "2 tbsp", notes: "" },
                { item: "Keto-friendly Sweetener", quantity: "1 tbsp", notes: "" }
            ],
            cookingInstructions: [
                "Mix all ingredients, roll into balls, and freeze until firm."
            ]
        },
        {
            name: "Chicken Wings",
            mealType: ["lunch", "dinner"],
            calories: 500,
            protein: 40,
            carbs: 5,
            fat: 35,
            price: 10.00,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: false,
                dairyFree: true,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Chicken Wings", quantity: "6-8", notes: "" },
                { item: "Hot Sauce", quantity: "1/4 cup", notes: "" },
                { item: "Butter", quantity: "2 tbsp", notes: "Melted" }
            ],
            cookingInstructions: [
                "Bake or air-fry chicken wings until crispy.",
                "Toss in a mixture of hot sauce and melted butter."
            ]
        },
        {
            name: "Egg Muffins",
            mealType: ["breakfast", "snack"],
            calories: 300,
            protein: 20,
            carbs: 5,
            fat: 22,
            price: 6.00,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: true,
                dairyFree: false,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Eggs", quantity: "6", notes: "" },
                { item: "Spinach", quantity: "1/2 cup", notes: "Chopped" },
                { item: "Cheese", quantity: "1/4 cup", notes: "Shredded" },
                { item: "Bacon", quantity: "2 slices", notes: "Cooked and crumbled" }
            ],
            cookingInstructions: [
                "Whisk eggs, then stir in bacon, cheese, and spinach.",
                "Pour into muffin tins and bake at 180°C for 15-20 minutes."
            ]
        },
        {
            name: "Tuna Stuffed Avocados",
            mealType: ["breakfast", "lunch", "dinner"],
            calories: 400,
            protein: 25,
            carbs: 10,
            fat: 30,
            price: 7.50,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: false,
                dairyFree: true,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Avocado", quantity: "1", notes: "Halved and pitted" },
                { item: "Canned Tuna", quantity: "1 can", notes: "" },
                { item: "Mayonnaise", quantity: "2 tbsp", notes: "" },
                { item: "Celery", quantity: "1 stalk", notes: "Finely chopped" }
            ],
            cookingInstructions: [
                "Mix tuna, mayonnaise, and celery.",
                "Spoon into avocado halves."
            ]
        },
        {
            name: "Cauliflower Pizza",
            mealType: ["snack", "dinner"],
            calories: 450,
            protein: 25,
            carbs: 15,
            fat: 30,    
            price: 11.00,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: true,
                dairyFree: false,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Cauliflower", quantity: "1 head", notes: "Riced" },
                { item: "Egg", quantity: "1", notes: "" },
                { item: "Cheese", quantity: "1 cup", notes: "Shredded" },
                { item: "Tomato Sauce", quantity: "1/4 cup", notes: "Low-carb" }
            ],
            cookingInstructions: [
                "Mix riced cauliflower with egg and half the cheese to form a crust.",
                "Bake until golden, then top with sauce and remaining cheese."
            ]
        },
        {
            name: "Cocoa Shake",
            mealType: ["breakfast", "snack"],
            calories: 350,
            protein: 15,
            carbs: 10,
            fat: 30,
            price: 6.00,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: true,
                dairyFree: false,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Almond Milk", quantity: "1 cup", notes: "Unsweetened" },
                { item: "Avocado", quantity: "1/2", notes: "" },
                { item: "Cocoa Powder", quantity: "2 tbsp", notes: "" },
                { item: "Keto-friendly Sweetener", quantity: "1 tbsp", notes: "" }
            ],
            cookingInstructions: [
                "Blend all ingredients until smooth."
            ]
        },
        {
            name: "Green Beans Pork Chops",
            mealType: ["lunch", "dinner"],
            calories: 500,
            protein: 35,
            carbs: 10,
            fat: 35,
            price: 12.00,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: false,
                dairyFree: true,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Pork Chops", quantity: "2", notes: "" },
                { item: "Green Beans", quantity: "1 cup", notes: "" },
                { item: "Garlic", quantity: "2 cloves", notes: "" },
                { item: "Olive Oil", quantity: "1 tbsp", notes: "" }
            ],
            cookingInstructions: [
                "Pan-fry pork chops until cooked through.",
                "Sauté green beans with garlic in olive oil."
            ]
        },
        {
            name: "Cobb Salad",
            mealType: ["lunch", "dinner"],
            calories: 480,
            protein: 30,
            carbs: 12,
            fat: 35,
            price: 9.50,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: false,
                dairyFree: false,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Chicken Breast", quantity: "100g", notes: "Grilled and diced" },
                { item: "Bacon", quantity: "2 slices", notes: "Crumbled" },
                { item: "Hard-boiled Egg", quantity: "1", notes: "Chopped" },
                { item: "Avocado", quantity: "1/2", notes: "Diced" }
            ],
            cookingInstructions: [
                "Arrange all ingredients on a bed of mixed greens and serve with ranch dressing."
            ]
        },
        {
            name: "Cloud Bread",
            mealType: ["breakfast", "snack"],
            calories: 100,
            protein: 10,
            carbs: 1,
            fat: 6,
            price: 4.00,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: true,
                dairyFree: false,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Eggs", quantity: "3", notes: "Separated" },
                { item: "Cream Cheese", quantity: "3 tbsp", notes: "" },
                { item: "Cream of Tartar", quantity: "1/4 tsp", notes: "" }
            ],
            cookingInstructions: [
                "Whip egg whites and cream of tartar until stiff peaks form.",
                "In another bowl, mix egg yolks and cream cheese.",
                "Gently fold the two mixtures together and bake in rounds at 150°C for 30 minutes."
            ]
        },
        {
            name: "Beef and Broccoli",
            mealType: ["lunch", "dinner"],
            calories: 450,
            protein: 30,
            carbs: 15,
            fat: 30,
            price: 11.50,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: false,
                dairyFree: true,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Beef", quantity: "150g", notes: "Sliced" },
                { item: "Broccoli", quantity: "1.5 cups", notes: "" },
                { item: "Soy Sauce", quantity: "2 tbsp", notes: "Or tamari for gluten-free" },
                { item: "Garlic", quantity: "2 cloves", notes: "" }
            ],
            cookingInstructions: [
                "Sauté beef and garlic, then add broccoli and soy sauce.",
                "Cook until broccoli is tender-crisp."
            ]
        },
        {
            name: "Halloumi Fries",
            mealType: ["snack"],
            calories: 350,
            protein: 20,
            carbs: 5,
            fat: 28,
            price: 7.00,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: true,
                dairyFree: false,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Halloumi Cheese", quantity: "200g", notes: "Sliced into fries" },
                { item: "Almond Flour", quantity: "1/4 cup", notes: "" },
                { item: "Spices", quantity: "To taste", notes: "Paprika, garlic powder" }
            ],
            cookingInstructions: [
                "Coat halloumi fries in seasoned almond flour and bake or air-fry until golden."
            ]
        },
        {
            name: "Chicken Mushroom Soup",
            mealType: ["lunch", "dinner"],
            calories: 380,
            protein: 25,
            carbs: 10,
            fat: 28,    
            price: 8.50,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: false,
                dairyFree: false,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Chicken Thighs", quantity: "150g", notes: "Cooked and shredded" },
                { item: "Mushrooms", quantity: "1 cup", notes: "Sliced" },
                { item: "Heavy Cream", quantity: "1/4 cup", notes: "" },
                { item: "Chicken Broth", quantity: "2 cups", notes: "" }
            ],
            cookingInstructions: [
                "Sauté mushrooms, add broth and chicken, and simmer.",
                "Stir in heavy cream before serving."
            ]
        },
        {
            name: "Deviled Eggs",
            mealType: ["breakfast", "snack"],
            calories: 200,
            protein: 12,
            carbs: 2,
            fat: 16,
            price: 4.00,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: true,
                dairyFree: true,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Eggs", quantity: "4", notes: "Hard-boiled" },
                { item: "Mayonnaise", quantity: "3 tbsp", notes: "" },
                { item: "Mustard", quantity: "1 tsp", notes: "" },
                { item: "Paprika", quantity: "For garnish", notes: "" }
            ],
            cookingInstructions: [
                "Halve hard-boiled eggs, mix yolks with mayonnaise and mustard, and refill egg whites."
            ]
        },
        {
            name: "Mushroom Chicken Thighs",
            mealType: ["lunch", "dinner"],
            calories: 380,
            protein: 25,
            carbs: 10,
            fat: 28,
            price: 8.50,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: false,
                dairyFree: false,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Chicken Thighs", quantity: "150g", notes: "Cooked and shredded" },
                { item: "Mushrooms", quantity: "1 cup", notes: "Sliced" },
                { item: "Heavy Cream", quantity: "1/4 cup", notes: "" },
                { item: "Chicken Broth", quantity: "2 cups", notes: "" }
            ],
            cookingInstructions: [
                "Sauté mushrooms, add broth and chicken, and simmer.",
                "Stir in heavy cream before serving."
            ]
        },
        {
            name: "Sausage and Peppers",
            mealType: ["lunch", "dinner"],
            calories: 480,
            protein: 20,
            carbs: 12,
            fat: 38,
            price: 9.00,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: false,
                dairyFree: true,
                glutenFree: true,
                keto: true
            },
            groceryList: [
                { item: "Italian Sausage", quantity: "2 links", notes: "" },
                { item: "Bell Peppers", quantity: "1.5 cups", notes: "Sliced" },
                { item: "Onion", quantity: "1/2", notes: "Sliced" },
                { item: "Olive Oil", quantity: "1 tbsp", notes: "" }
            ],
            cookingInstructions: [
                "Sauté sausage, peppers, and onion in olive oil until cooked through."
            ]
        },
  {
    name: "Peanut Butter Toast",
    mealType: ["breakfast", "lunch", "snack"],
    calories: 220,
    protein: 8,
    carbs: 20,
    fat: 12,
    price: 2.50,
    dietaryRestrictions: {
      vegan: true,
      vegetarian: true,
      dairyFree: true,
      glutenFree: false,
      keto: false
    },
    groceryList: [
      { item: "Whole Wheat Bread", quantity: "1 slice", notes: "Use gluten-free if needed" },
      { item: "Peanut Butter", quantity: "1 tbsp", notes: "Natural, no added sugar" }
    ],
    cookingInstructions: [
      "Toast the bread slice until golden brown",
      "Spread peanut butter evenly on top",
      "Serve warm or at room temperature"
    ]
  },
  {
    name: "Banana Oatmeal",
    mealType: ["breakfast" , "snack"],
    calories: 250,
    protein: 6,
    carbs: 40,
    fat: 5,
    price: 3.00,
    dietaryRestrictions: {
      vegan: true,
      vegetarian: true,
      dairyFree: true,
      glutenFree: true,
      keto: false
    },
    groceryList: [
      { item: "Rolled Oats", quantity: "1/2 cup", notes: "Gluten-free certified" },
      { item: "Banana", quantity: "1 medium", notes: "Ripe" },
      { item: "Water or Plant Milk", quantity: "1 cup", notes: "Unsweetened preferred" }
    ],
    cookingInstructions: [
      "Combine oats and water/plant milk in a pot",
      "Cook on medium heat, stirring occasionally",
      "Mash the banana and add it halfway through cooking",
      "Cook until desired consistency is reached",
      "Serve hot"
    ]
  },
  {
    name: "Cucumber Sandwich",
    mealType: ["lunch", "snack"],
    calories: 150,
    protein: 4,
    carbs: 20,
    fat: 6,
    price: 2.80,
    dietaryRestrictions: {
      vegan: false,
      vegetarian: true,
      dairyFree: false,
      glutenFree: false,
      keto: false
    },
    groceryList: [
      { item: "Bread Slices", quantity: "2 slices", notes: "Wholemeal preferred" },
      { item: "Cucumber", quantity: "1/2 cucumber", notes: "Thinly sliced" },
      { item: "Cream Cheese or Butter", quantity: "1 tbsp", notes: "Spreadable" }
    ],
    cookingInstructions: [
      "Spread cream cheese or butter on one side of each bread slice",
      "Layer cucumber slices evenly on one slice",
      "Top with the other slice to form a sandwich",
      "Cut and serve"
    ]
  },
  {
    name: "Tuna Rice Bowl",
    mealType: ["lunch", "dinner"],
    calories: 300,
    protein: 18,
    carbs: 30,
    fat: 10,
    price: 4.50,
    dietaryRestrictions: {
      vegan: false,
      vegetarian: false,
      dairyFree: true,
      glutenFree: true,
      keto: false
    },
    groceryList: [
      { item: "Canned Tuna", quantity: "1 can", notes: "In water, drained" },
      { item: "Cooked Rice", quantity: "1 cup", notes: "White or brown rice" },
      { item: "Soy Sauce", quantity: "1 tsp", notes: "Optional, for flavor" }
    ],
    cookingInstructions: [
      "Heat rice if not already warm",
      "Top rice with canned tuna",
      "Drizzle with a bit of soy sauce if desired",
      "Mix and serve"
    ]
  },
  {
    name: "Cucumber Sandwich",
    mealType: ["breakfast", "dinner", "snack"],
    calories: 150,
    protein: 4,
    carbs: 20,
    fat: 6,
    price: 3.80,
    dietaryRestrictions: {
      vegan: false,
      vegetarian: true,
      dairyFree: false,
      glutenFree: false,
      keto: false
    },
    groceryList: [
      { item: "Bread Slices", quantity: "2 slices", notes: "Wholemeal preferred" },
      { item: "Cucumber", quantity: "1/2 cucumber", notes: "Thinly sliced" },
      { item: "Cream Cheese or Butter", quantity: "1 tbsp", notes: "Spreadable" }
    ],
    cookingInstructions: [
      "Spread cream cheese or butter on one side of each bread slice",
      "Layer cucumber slices evenly on one slice",
      "Top with the other slice to form a sandwich",
      "Cut and serve"
    ]
  },
  {
    name: "Fried Egg Rice",
    mealType: ["lunch", "dinner", "snack"],
    calories: 320,
    protein: 10,
    carbs: 35,
    fat: 15,
    price: 5.50,
    dietaryRestrictions: {
      vegan: false,
      vegetarian: true,
      dairyFree: true,
      glutenFree: true,
      keto: false
    },
    groceryList: [
      { item: "Cooked Rice", quantity: "1 cup", notes: "Preferably cold" },
      { item: "Egg", quantity: "1 large", notes: "Free-range if possible" },
      { item: "Soy Sauce", quantity: "1 tsp", notes: "Optional" },
      { item: "Cooking Oil", quantity: "1 tsp", notes: "Any neutral oil" }
    ],
    cookingInstructions: [
      "Heat oil in a pan over medium heat",
      "Crack in the egg and fry until yolk is set",
      "Remove egg, add rice to the pan and stir-fry",
      "Add soy sauce and mix well",
      "Top rice with fried egg and serve"
    ]
  },
        {
            name: "Caesar Salad",
            mealType: ["breakfast", "dinner", "snack"],
            calories: 280,
            protein: 22,
            carbs: 8,
            fat: 18,
            price: 7.50,
            dietaryRestrictions: {
                vegan: false,
                vegetarian: false,
                dairyFree: false,
                glutenFree: false,
                keto: false
            },
            groceryList: [
                { item: "Romaine Lettuce", quantity: "2 cups", notes: "Chopped" },
                { item: "Chicken Breast", quantity: "120g", notes: "Grilled" },
                { item: "Parmesan Cheese", quantity: "2 tbsp", notes: "Shredded" },
                { item: "Caesar Dressing", quantity: "2 tbsp", notes: "Low-carb" }
            ],
            cookingInstructions: [
                "Toss lettuce with dressing",
                "Top with grilled chicken and parmesan"
            ]
        },
    {
    name: "Vegetable Fried Rice",
    mealType: ["lunch", "dinner"],
    calories: 300,
    protein: 7,
    carbs: 45,
    fat: 10,
    price: 5.50,
    dietaryRestrictions: {
      vegan: true,
      vegetarian: true,
      dairyFree: true,
      glutenFree: true,
      keto: false
    },
    groceryList: [
      { item: "Cooked Rice", quantity: "1 cup", notes: "Day-old rice works best" },
      { item: "Mixed Vegetables", quantity: "1/2 cup", notes: "Carrots, peas, corn" },
      { item: "Soy Sauce", quantity: "1 tsp", notes: "Optional for flavor" },
      { item: "Cooking Oil", quantity: "1 tsp", notes: "Any neutral oil" }
    ],
    cookingInstructions: [
      "Heat oil in a pan over medium heat",
      "Add mixed vegetables and sauté for 2-3 minutes",
      "Add rice and stir-fry for 3-5 minutes",
      "Add soy sauce and mix well",
      "Serve hot"
    ]
  },
  {
    name: "Sardine Sandwich",
    mealType: ["breakfast", "dinner", "snack"],
    calories: 280,
    protein: 14,
    carbs: 22,
    fat: 15,
    price: 4.50,
    dietaryRestrictions: {
      vegan: false,
      vegetarian: false,
      dairyFree: true,
      glutenFree: false,
      keto: false
    },
    groceryList: [
      { item: "Canned Sardines", quantity: "1/2 can", notes: "In tomato sauce" },
      { item: "Bread Slices", quantity: "2 slices", notes: "Wholemeal or white" },
      { item: "Onion", quantity: "Few slices", notes: "Optional" }
    ],
    cookingInstructions: [
      "Mash sardines in a bowl",
      "Toast bread lightly if desired",
      "Spread sardines evenly between slices",
      "Add onion slices if using",
      "Close sandwich and serve"
    ]
  },
  {
    name: "Egg Fried Noodles",
    mealType: ["lunch", "dinner"],
    calories: 400,
    protein: 10,
    carbs: 50,
    fat: 15,
    price: 4.50,
    dietaryRestrictions: {
      vegan: false,
      vegetarian: true,
      dairyFree: true,
      glutenFree: false,
      keto: false
    },
    groceryList: [
      { item: "Instant Noodles", quantity: "1 pack", notes: "Any brand, discard seasoning if high in sodium" },
      { item: "Egg", quantity: "1", notes: "Free-range if possible" },
      { item: "Vegetable Oil", quantity: "1 tsp", notes: "For frying" },
      { item: "Soy Sauce", quantity: "1 tsp", notes: "For seasoning" }
    ],
    cookingInstructions: [
      "Boil noodles and drain",
      "Heat oil in a pan and scramble the egg",
      "Add noodles and soy sauce, stir well",
      "Cook for 2-3 minutes and serve hot"
    ]
  },
  {
    name: "Nasi Lemak",
    mealType: ["lunch", "dinner"],
    calories: 400,
    protein: 10,
    carbs: 45,
    fat: 18,
    price: 4.50,
    dietaryRestrictions: {
      vegan: false,
      vegetarian: true,
      dairyFree: true,
      glutenFree: true,
      keto: false
    },
    groceryList: [
      { item: "Rice", quantity: "1 cup", notes: "Cooked with a bit of coconut milk and pandan" },
      { item: "Boiled Egg", quantity: "1", notes: "Peeled" },
      { item: "Sambal", quantity: "2 tbsp", notes: "Spicy chili paste, optional store-bought" },
      { item: "Cucumber", quantity: "3-4 slices", notes: "Fresh" },
      { item: "Peanuts & Anchovies", quantity: "Small handful", notes: "Optional, lightly fried" }
    ],
    cookingInstructions: [
      "Cook rice with coconut milk and pandan leaves until fluffy",
      "Boil egg and peel once cooled",
      "Assemble rice, egg, sambal, cucumber, and optional peanuts/anchovies on a plate",
      "Serve warm"
    ]
  },
  {
    name: "Omelette Toast",
    mealType: ["breakfast", "dinner", "snack"],
    calories: 300,
    protein: 12,
    carbs: 25,
    fat: 15,
    price: 4.00,
    dietaryRestrictions: {
      vegan: false,
      vegetarian: true,
      dairyFree: true,
      glutenFree: false,
      keto: false
    },
    groceryList: [
      { item: "Eggs", quantity: "2", notes: "Free-range if possible" },
      { item: "Bread Slices", quantity: "2 slices", notes: "Any type, toast before serving" },
      { item: "Salt and Pepper", quantity: "To taste", notes: "For seasoning" },
      { item: "Oil or Butter", quantity: "1 tsp", notes: "For frying" }
    ],
    cookingInstructions: [
      "Crack eggs into a bowl, season with salt and pepper, and beat well",
      "Heat pan and add oil or butter",
      "Pour in the egg and cook until set, flip if desired",
      "Toast bread and place omelette between slices or on top",
      "Serve warm"
    ]
  },
  {
    name: "Rice Porridge",
    mealType: ["lunch", "dinner"],
    calories: 280,
    protein: 6,
    carbs: 45,
    fat: 5,
    price: 4.50,
    dietaryRestrictions: {
      vegan: true,
      vegetarian: true,
      dairyFree: true,
      glutenFree: true,
      keto: false
    },
    groceryList: [
      { item: "Rice", quantity: "1/4 cup", notes: "Short grain preferred" },
      { item: "Water", quantity: "2–3 cups", notes: "Adjust for consistency" },
      { item: "Salt", quantity: "To taste", notes: "Optional" },
      { item: "Spring Onion or Fried Shallots", quantity: "Optional garnish", notes: "For flavor" }
    ],
    cookingInstructions: [
      "Rinse rice and combine with water in a pot",
      "Simmer on low heat for 30–40 minutes, stirring occasionally",
      "Add salt to taste once desired consistency is reached",
      "Top with spring onions or fried shallots before serving"
    ]
  }

],
    
    // Diet type constraints
    dietTypeConstraints: {
        regular: {
            protein: 0.25, // 25% 
            carbs: 0.50,   // 50%
            fat: 0.25      // 25% 
        },
        keto: {
            protein: 0.20,
            carbs: 0.05,   
            fat: 0.75     
        },
        vegan: {
            protein: 0.20, 
            carbs: 0.55,  
            fat: 0.25      
        },
        vegetarian: {
            protein: 0.20, 
            carbs: 0.55,   
            fat: 0.25     
        },
        "dairy-free": {
            protein: 0.25,
            carbs: 0.50,   
            fat: 0.25      
        },
        "gluten-free": {
            protein: 0.25, 
            carbs: 0.45,   
            fat: 0.30      
        }
    },
    
    // foods filtered by meal type and dietary restriction
    getFilteredFoods: function(mealType, dietType) {
        return this.foods.filter(food => {
            // Filter by meal type
            let foodMealTypes = food.mealType;
            
            if (typeof foodMealTypes === 'string') {
                foodMealTypes = [foodMealTypes];
            }
            
            if (!foodMealTypes.includes(mealType)) return false;
            
            // Filter by dietary restrictions
            switch(dietType) {
                case 'vegan':
                    return food.dietaryRestrictions.vegan;
                case 'vegetarian':
                    return food.dietaryRestrictions.vegetarian;
                case 'dairy-free':
                    return food.dietaryRestrictions.dairyFree;
                case 'gluten-free':
                    return food.dietaryRestrictions.glutenFree;
                case 'keto':
                    return food.dietaryRestrictions.keto;
                case 'regular':
                default:
                    return true; 
            }
        });
    },
    
    getDietConstraints: function(dietType) {
        return this.dietTypeConstraints[dietType] || this.dietTypeConstraints.regular;
    },
    
    getDaysForDuration: function(duration) {
        const days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        return days.slice(0, duration);
    }
};

window.FoodDB = FoodDB;
