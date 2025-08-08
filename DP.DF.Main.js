/*
Programmer Name : Siew Zhen Lynn (TP076386), Sim Tian (TP077056)
Program Name    : DP.DF.Main.js
Description     : Diet Plans Food
First Written on: Sunday, 15-June-2025
Edited on: 05-July-2025
*/

window.updateMeals = function(planType, day) {
  const meals = window.mealPlans[planType]?.[day];
  const container = document.querySelector('.meals-container');

  if (!meals || !container) {
      container.innerHTML = '<p>Meal plan not available for this selection.</p>';
      return;
  }

  let html = '';
  for (const mealType in meals) {
      const meal = meals[mealType];
      const iconClass = {
          breakfast: 'fa-mug-saucer',
          lunch: 'fa-sun',
          dinner: 'fa-moon',
          snack: 'fa-cookie-bite'
      }[mealType] || 'fa-utensils';

      html += `
          <div class="meal" id="meal-${day}-${mealType}">
              <div class="meal-info">
                  <div class="meal-icon"><i class="fas ${iconClass}"></i></div>
                  <div class="meal-content">
                      <div class="meal-type">${mealType.charAt(0).toUpperCase() + mealType.slice(1)}</div>
                      <div class="meal-items">
                          ${meal.items.map(item => `<span class="meal-item">${item}</span>`).join('')}
                      </div>
                      <div class="meal-details">
                          <span>${meal.calories} kcal</span>
                          <span>RM ${meal.price.toFixed(2)}</span>
                      </div>
                  </div>
              </div>
              <div class="meal-action">
                  <button class="details-btn" data-plan="${planType}" data-day="${day}" data-meal="${mealType}">Details</button>
              </div>
          </div>
      `;
  }
  container.innerHTML = html;
};


window.mealPlans = {
"regular": {
  "monday": {
    "breakfast": {
      "items": ["Nasi Lemak", "Fried Chicken", "Sambal", "Cucumber"],
      "calories": 650,
      "price": 8.50,
      "title": "Nasi Lemak with Fried Chicken",
      "groceryList": [
        {"item": "Rice", "quantity": "200g", "notes": "Jasmine or long grain"},
        {"item": "Coconut Milk", "quantity": "200ml", "notes": "Full fat"},
        {"item": "Pandan Leaf", "quantity": "2 pieces", "notes": "Fresh or frozen"}
      ],
      "cookingInstructions": [
        {
          "title": "🍚 Coconut Rice (Nasi Lemak)",
          "ingredients": ["200g rice", "200ml coconut milk", "200ml water"],
          "instructions": [
            "Rinse rice until water runs clear",
            "Place rice in a pot with coconut milk, water, salt and pandan leaf",
            "Bring to a boil, then reduce heat to low"
          ]
        }
      ]
    },
    "lunch": {
      "items": ["Chicken Rice", "Roasted Chicken", "Soup", "Chili Sauce"],
      "calories": 580,
      "price": 12.00,
      "title": "Hainanese Chicken Rice",
      "groceryList": [
        {"item": "Whole Chicken", "quantity": "1 (1.5kg)", "notes": "Preferably free-range"},
        {"item": "Rice", "quantity": "2 cups", "notes": "Jasmine or long grain"}
      ],
      "cookingInstructions": [
        {
          "title": "🍗 Poached Chicken",
          "ingredients": ["1 whole chicken (1.5kg)", "4 slices ginger", "4 cloves garlic"],
          "instructions": [
            "Clean chicken thoroughly and remove excess fat",
            "Bring a large pot of water to a boil with ginger, garlic, spring onions and salt"
          ]
        }
      ]
    },
    "dinner": {
      "items": ["Beef Rendang", "Steamed Rice", "Kangkung Belacan"],
      "calories": 720,
      "price": 18.50,
      "title": "Beef Rendang with Sides",
      "groceryList": [
        {"item": "Beef Chuck or Brisket", "quantity": "500g", "notes": "Cut into 2-inch cubes"},
        {"item": "Lemongrass", "quantity": "3 stalks", "notes": "Bruised and cut"}
      ],
      "cookingInstructions": [
        {
          "title": "🔪 Rendang Paste",
          "ingredients": ["8 shallots", "5 cloves garlic"],
          "instructions": [
            "Cut all ingredients into small pieces",
            "Blend all ingredients into a smooth paste, adding a little water if necessary"
          ]
        }
      ]
    },
    "snack": {
      "items": ["Roti Canai", "Teh Tarik"],
      "calories": 380,
      "price": 6.50,
      "title": "Malaysian Teatime: Roti Canai & Teh Tarik",
      "groceryList": [
        {"item": "All-Purpose Flour", "quantity": "2 cups", "notes": "For roti dough"},
        {"item": "Salt", "quantity": "1/2 tsp", "notes": "For roti dough"}
      ],
      "cookingInstructions": [
        {
          "title": "🥖 Roti Canai",
          "ingredients": ["2 cups all-purpose flour", "1/2 tsp salt"],
          "instructions": [
            "Mix flour, salt and sugar in a bowl",
            "Gradually add water, mixing to form a soft, sticky dough"
          ]
        }
      ]
    }
  },
  "tuesday": {
      "breakfast": {
        "items": ["Roti Jala with Chicken Curry", "Fruits", "Coffee"],
        "calories": 548,
        "price": 7.91,
        "title": "Roti Jala with Chicken Curry",
        "groceryList": [
          {"item": "Flour", "quantity": "250g", "notes": "All-purpose"},
          {"item": "Eggs", "quantity": "2", "notes": "Large size"},
          {"item": "Chicken", "quantity": "300g", "notes": "Boneless, skinless"}
        ],
        "cookingInstructions": [
          {
            "title": "🍞 Roti Jala Batter",
            "ingredients": ["Flour", "Eggs", "Coconut Milk"],
            "instructions": [
              "Mix all ingredients to form a smooth batter",
              "Use a roti jala mold to drizzle batter onto hot pan",
              "Cook both sides briefly"
            ]
          }
        ]
      },
      "lunch": {
        "items": ["Char Kway Teow", "Iced Lemon Tea"],
        "calories": 703,
        "price": 13.87,
        "title": "Char Kway Teow",
        "groceryList": [
          {"item": "Flat Rice Noodles", "quantity": "200g", "notes": "Fresh or dried"},
          {"item": "Prawns", "quantity": "150g", "notes": "Shelled and deveined"}
        ],
        "cookingInstructions": [
          {
            "title": "🔥 Char Kway Teow Stir-fry",
            "ingredients": ["Noodles", "Prawns", "Garlic", "Soy Sauce"],
            "instructions": [
              "Heat wok until smoking",
              "Add oil and fry garlic, then prawns",
              "Add noodles and sauces, stir-fry well"
            ]
          }
        ]
      },
      "dinner": {
        "items": ["Ikan Bakar with Sambal", "Rice", "Vegetables"],
        "calories": 722,
        "price": 17.86,
        "title": "Ikan Bakar with Sambal",
        "groceryList": [
          {"item": "Whole Fish", "quantity": "1 medium", "notes": "Seabass or stingray"},
          {"item": "Banana Leaf", "quantity": "1 large", "notes": "Fresh or thawed"}
        ],
        "cookingInstructions": [
          {
            "title": "🔥 Grilled Fish",
            "ingredients": ["Fish", "Sambal", "Banana Leaf"],
            "instructions": [
              "Wrap marinated fish in banana leaf",
              "Grill on charcoal until cooked through"
            ]
          }
        ]
      },
      "snack": {
        "items": ["Kuih Lapis", "Teh O"],
        "calories": 386,
        "price": 6.40,
        "title": "Kuih Lapis & Teh O",
        "groceryList": [
          {"item": "Tapioca Flour", "quantity": "200g", "notes": "Fine"},
          {"item": "Coconut Milk", "quantity": "300ml", "notes": "Full fat"}
        ],
        "cookingInstructions": [
          {
            "title": "🌈 Kuih Lapis Layers",
            "ingredients": ["Tapioca Flour", "Coconut Milk", "Sugar", "Coloring"],
            "instructions": [
              "Mix batter and divide into colored portions",
              "Steam each layer one by one in a tray"
            ]
          }
        ]
    }
  },
  "wednesday": {
      "breakfast": {
        "items": ["Roti Jala", "Chicken Curry", "Coconut Jam"],
        "calories": 610,
        "price": 7.50,
        "title": "Roti Jala with Chicken Curry",
        "groceryList": [
          {"item": "Flour", "quantity": "250g", "notes": "All-purpose"},
          {"item": "Eggs", "quantity": "2", "notes": "Large"},
          {"item": "Coconut Milk", "quantity": "300ml", "notes": "Thick"}
        ],
        "cookingInstructions": [
          {
            "title": "🥞 Roti Jala Batter",
            "ingredients": ["250g flour", "2 eggs", "300ml coconut milk"],
            "instructions": [
              "Mix all ingredients until smooth batter forms",
              "Use roti jala cup to drizzle batter onto hot non-stick pan in net pattern",
              "Fold and serve with curry"
            ]
          }
        ]
      },
      "lunch": {
        "items": ["Mee Rebus", "Boiled Egg", "Green Chilies"],
        "calories": 590,
        "price": 11.00,
        "title": "Mee Rebus Johor",
        "groceryList": [
          {"item": "Yellow Noodles", "quantity": "2 servings", "notes": "Fresh"},
          {"item": "Sweet Potato", "quantity": "1 large", "notes": "Boiled and mashed"}
        ],
        "cookingInstructions": [
          {
            "title": "🍜 Mee Rebus Gravy",
            "ingredients": ["Mashed sweet potato", "Shrimp paste", "Curry powder"],
            "instructions": [
              "Blend gravy base ingredients",
              "Simmer until thick and aromatic",
              "Serve hot over noodles with toppings"
            ]
          }
        ]
      },
      "dinner": {
        "items": ["Char Kuey Teow", "Prawns", "Chinese Sausage"],
        "calories": 730,
        "price": 16.00,
        "title": "Penang Char Kuey Teow",
        "groceryList": [
          {"item": "Flat Rice Noodles", "quantity": "200g", "notes": "Fresh or soaked dry"},
          {"item": "Prawns", "quantity": "100g", "notes": "Deshelled"}
        ],
        "cookingInstructions": [
          {
            "title": "🔥 Char Kuey Teow Stir-Fry",
            "ingredients": ["Rice noodles", "Garlic", "Soy sauce", "Chili paste"],
            "instructions": [
              "Heat wok until smoking hot",
              "Stir-fry garlic, prawns, sausage, and noodles quickly",
              "Add sauce and toss well before serving"
            ]
          }
        ]
      },
      "snack": {
        "items": ["Kuih Seri Muka", "Barley Drink"],
        "calories": 320,
        "price": 5.50,
        "title": "Kuih Seri Muka with Barley",
        "groceryList": [
          {"item": "Glutinous Rice", "quantity": "200g", "notes": "Soaked overnight"},
          {"item": "Pandan Juice", "quantity": "150ml", "notes": "Freshly extracted"}
        ],
        "cookingInstructions": [
          {
            "title": "🍰 Layered Seri Muka",
            "ingredients": ["Glutinous rice", "Coconut milk", "Pandan juice"],
            "instructions": [
              "Steam glutinous rice with coconut milk",
              "Pour pandan layer on top and steam again until set",
              "Cool and cut into squares"
            ]
          }
        ]
      }
    },
    "thursday": {
      "breakfast": {
        "items": ["Chee Cheong Fun", "Sweet Sauce", "Sesame Seeds"],
        "calories": 560,
        "price": 6.50,
        "title": "Chee Cheong Fun with Sauce",
        "groceryList": [
          {"item": "Rice Flour", "quantity": "150g", "notes": "For steamed rolls"},
          {"item": "Sweet Sauce", "quantity": "100ml", "notes": "Ready-made or homemade"}
        ],
        "cookingInstructions": [
          {
            "title": "🥢 Chee Cheong Fun",
            "ingredients": ["Rice flour", "Tapioca flour", "Water"],
            "instructions": [
              "Mix flours and water into thin batter",
              "Steam in thin layers and roll gently",
              "Top with sauce and sesame seeds"
            ]
          }
        ]
      },
      "lunch": {
        "items": ["Laksa", "Fish Balls", "Mint Leaves"],
        "calories": 670,
        "price": 13.50,
        "title": "Asam Laksa",
        "groceryList": [
          {"item": "Laksa Noodles", "quantity": "2 servings", "notes": "Thick rice noodles"},
          {"item": "Tamarind Paste", "quantity": "2 tbsp", "notes": "For sourness"}
        ],
        "cookingInstructions": [
          {
            "title": "🍲 Laksa Broth",
            "ingredients": ["Mackerel fish", "Tamarind", "Torch ginger flower"],
            "instructions": [
              "Boil and flake fish",
              "Simmer with spices and tamarind",
              "Serve with noodles and garnishes"
            ]
          }
        ]
      },
      "dinner": {
        "items": ["Ayam Masak Merah", "Tomato Rice", "Acar"],
        "calories": 750,
        "price": 17.00,
        "title": "Ayam Masak Merah with Tomato Rice",
        "groceryList": [
          {"item": "Chicken Thighs", "quantity": "4 pieces", "notes": "Bone-in preferred"},
          {"item": "Tomato Puree", "quantity": "150ml", "notes": "For sauce"}
        ],
        "cookingInstructions": [
          {
            "title": "🍅 Spicy Tomato Chicken",
            "ingredients": ["Chicken", "Tomato puree", "Chili paste"],
            "instructions": [
              "Fry chicken until golden",
              "Simmer with spicy tomato sauce",
              "Serve with fragrant rice and pickles"
            ]
          }
        ]
      },
      "snack": {
        "items": ["Curry Puff", "Milo Ice"],
        "calories": 390,
        "price": 5.00,
        "title": "Curry Puff and Milo",
        "groceryList": [
          {"item": "Potatoes", "quantity": "2", "notes": "Boiled and diced"},
          {"item": "Pastry Dough", "quantity": "1 roll", "notes": "For wrapping"}
        ],
        "cookingInstructions": [
          {
            "title": "🥟 Fried Curry Puff",
            "ingredients": ["Potatoes", "Curry powder", "Onion"],
            "instructions": [
              "Make filling with curried potatoes and onion",
              "Wrap in pastry and seal edges",
              "Deep fry until golden brown"
            ]
          }
        ]
      }
    },
    "friday": {
      "breakfast": {
        "items": ["Half-Boiled Eggs", "Kaya Toast", "Coffee"],
        "calories": 480,
        "price": 6.00,
        "title": "Half-Boiled Eggs with Kaya Toast",
        "groceryList": [
          {"item": "Eggs", "quantity": "2", "notes": "Room temperature"},
          {"item": "White Bread", "quantity": "2 slices", "notes": "Toasted"},
          {"item": "Kaya Jam", "quantity": "2 tbsp", "notes": "Preferably homemade"}
        ],
        "cookingInstructions": [
          {
            "title": "🍳 Traditional Kopitiam Breakfast",
            "ingredients": ["Eggs", "Bread", "Kaya", "Butter"],
            "instructions": [
              "Place eggs in hot water for 6 minutes",
              "Toast bread and spread with butter and kaya",
              "Serve eggs with soy sauce and white pepper"
            ]
          }
        ]
      },
      "lunch": {
        "items": ["Chicken Rice", "Chili Sauce", "Cucumber"],
        "calories": 640,
        "price": 12.00,
        "title": "Hainanese Chicken Rice",
        "groceryList": [
          {"item": "Chicken", "quantity": "Half", "notes": "Poached"},
          {"item": "Jasmine Rice", "quantity": "1 cup", "notes": "Washed"},
          {"item": "Ginger", "quantity": "2 inches", "notes": "Fresh"}
        ],
        "cookingInstructions": [
          {
            "title": "🍗 Hainanese Chicken Rice Set",
            "ingredients": ["Chicken", "Rice", "Ginger", "Garlic", "Soy sauce"],
            "instructions": [
              "Poach chicken and reserve broth",
              "Cook rice in chicken broth with garlic and ginger",
              "Serve with chili sauce and cucumber"
            ]
          }
        ]
      },
      "dinner": {
        "items": ["Ikan Bakar", "Ulam", "Sambal Belacan"],
        "calories": 710,
        "price": 15.50,
        "title": "Grilled Fish with Ulam and Sambal",
        "groceryList": [
          {"item": "Whole Fish", "quantity": "1", "notes": "Sea bass or stingray"},
          {"item": "Banana Leaf", "quantity": "2 pieces", "notes": "For wrapping"},
          {"item": "Sambal", "quantity": "100g", "notes": "Spicy and tangy"}
        ],
        "cookingInstructions": [
          {
            "title": "🔥 Ikan Bakar",
            "ingredients": ["Fish", "Sambal", "Banana leaf"],
            "instructions": [
              "Marinate fish with sambal",
              "Wrap in banana leaf and grill over charcoal",
              "Serve with fresh ulam and sambal belacan"
            ]
          }
        ]
      },
      "snack": {
        "items": ["Keropok Lekor", "Chili Sauce"],
        "calories": 350,
        "price": 4.50,
        "title": "Keropok Lekor with Chili Dip",
        "groceryList": [
          {"item": "Fish Paste", "quantity": "200g", "notes": "Fresh or frozen"},
          {"item": "Sago Flour", "quantity": "100g", "notes": "Fine texture"}
        ],
        "cookingInstructions": [
          {
            "title": "🐟 Homemade Keropok Lekor",
            "ingredients": ["Fish paste", "Sago flour", "Salt", "Water"],
            "instructions": [
              "Mix fish paste with sago and seasonings",
              "Shape into logs and boil, then slice",
              "Deep fry until crispy and serve with chili sauce"
            ]
          }
        ]
      }
    },
    "saturday": {
      "breakfast": {
        "items": ["Chee Cheong Fun", "Sweet Sauce", "Sesame Seeds"],
        "calories": 400,
        "price": 5.50,
        "title": "Steamed Chee Cheong Fun with Sauce",
        "groceryList": [
          {"item": "Rice Noodle Rolls", "quantity": "200g", "notes": "Fresh or pre-packed"},
          {"item": "Sweet Sauce", "quantity": "3 tbsp", "notes": "Thick and dark"},
          {"item": "Sesame Seeds", "quantity": "1 tsp", "notes": "Toasted"}
        ],
        "cookingInstructions": [
          {
            "title": "🥢 Chee Cheong Fun",
            "ingredients": ["Rice noodle rolls", "Sweet sauce", "Sesame seeds"],
            "instructions": [
              "Steam rice rolls until soft",
              "Drizzle with sweet sauce",
              "Sprinkle sesame seeds on top and serve"
            ]
          }
        ]
      },
      "lunch": {
        "items": ["Mee Rebus", "Boiled Egg", "Tofu"],
        "calories": 680,
        "price": 10.00,
        "title": "Mee Rebus with Egg and Tofu",
        "groceryList": [
          {"item": "Yellow Noodles", "quantity": "200g", "notes": "Blanched"},
          {"item": "Sweet Potato Gravy", "quantity": "300ml", "notes": "Thick and spicy"},
          {"item": "Boiled Egg", "quantity": "1", "notes": "Peeled and halved"}
        ],
        "cookingInstructions": [
          {
            "title": "🍜 Mee Rebus",
            "ingredients": ["Noodles", "Gravy", "Egg", "Tofu", "Lime"],
            "instructions": [
              "Pour hot gravy over noodles",
              "Top with egg, tofu, and fried shallots",
              "Serve with a wedge of lime"
            ]
          }
        ]
      },
      "dinner": {
        "items": ["Ayam Masak Merah", "Tomato Rice", "Acar"],
        "calories": 760,
        "price": 16.50,
        "title": "Spicy Tomato Chicken with Sides",
        "groceryList": [
          {"item": "Chicken Thighs", "quantity": "4 pieces", "notes": "Skinless"},
          {"item": "Tomato Puree", "quantity": "200ml", "notes": "For sauce"},
          {"item": "Spices", "quantity": "To taste", "notes": "Cinnamon, cloves"}
        ],
        "cookingInstructions": [
          {
            "title": "🍅 Ayam Masak Merah",
            "ingredients": ["Chicken", "Tomato puree", "Spices", "Onion", "Garlic"],
            "instructions": [
              "Fry chicken until golden and set aside",
              "Sauté onion, garlic, and spices",
              "Add tomato puree and simmer chicken in sauce"
            ]
          }
        ]
      },
      "snack": {
        "items": ["Kuih Lapis", "Teh O"],
        "calories": 300,
        "price": 3.50,
        "title": "Layered Cake with Tea",
        "groceryList": [
          {"item": "Tapioca Flour", "quantity": "1 cup", "notes": "For kuih base"},
          {"item": "Coconut Milk", "quantity": "200ml", "notes": "Rich and creamy"}
        ],
        "cookingInstructions": [
          {
            "title": "🌈 Kuih Lapis",
            "ingredients": ["Tapioca flour", "Coconut milk", "Sugar", "Food coloring"],
            "instructions": [
              "Mix ingredients and divide into colored layers",
              "Steam layer by layer until firm",
              "Cool and cut into slices"
            ]
          }
        ]
      }
    },
    "sunday": {
      "breakfast": {
        "items": ["Lontong", "Sambal", "Tempeh", "Egg"],
        "calories": 560,
        "price": 7.50,
        "title": "Lontong with Sambal and Tempeh",
        "groceryList": [
          {"item": "Rice Cakes", "quantity": "200g", "notes": "Cut into cubes"},
          {"item": "Coconut Gravy", "quantity": "250ml", "notes": "For soup"},
          {"item": "Tempeh", "quantity": "100g", "notes": "Fried"}
        ],
        "cookingInstructions": [
          {
            "title": "🥥 Lontong",
            "ingredients": ["Rice cakes", "Coconut gravy", "Vegetables", "Sambal"],
            "instructions": [
              "Prepare coconut vegetable gravy",
              "Add rice cakes to gravy and heat gently",
              "Serve with sambal and fried tempeh"
            ]
          }
        ]
      },
      "lunch": {
        "items": ["Laksa Johor", "Spaghetti", "Fish Gravy"],
        "calories": 720,
        "price": 13.00,
        "title": "Laksa Johor with Spaghetti",
        "groceryList": [
          {"item": "Spaghetti", "quantity": "200g", "notes": "Cooked al dente"},
          {"item": "Mackerel Fish", "quantity": "2 pieces", "notes": "Deboned and flaked"},
          {"item": "Laksa Paste", "quantity": "3 tbsp", "notes": "Ready-made or homemade"}
        ],
        "cookingInstructions": [
          {
            "title": "🐟 Laksa Johor",
            "ingredients": ["Fish", "Laksa paste", "Coconut milk", "Spaghetti"],
            "instructions": [
              "Cook fish in laksa gravy with coconut milk",
              "Boil spaghetti and drain",
              "Pour gravy over spaghetti and serve with garnishes"
            ]
          }
        ]
      },
      "dinner": {
        "items": ["Char Kuey Teow", "Cockles", "Bean Sprouts", "Chives"],
        "calories": 790,
        "price": 11.00,
        "title": "Char Kuey Teow with Cockles",
        "groceryList": [
          {"item": "Flat Rice Noodles", "quantity": "200g", "notes": "Fresh"},
          {"item": "Cockles", "quantity": "100g", "notes": "Cleaned"},
          {"item": "Soy Sauce", "quantity": "2 tbsp", "notes": "Light and dark"}
        ],
        "cookingInstructions": [
          {
            "title": "🔥 Char Kuey Teow",
            "ingredients": ["Flat noodles", "Egg", "Cockles", "Soy sauce", "Garlic"],
            "instructions": [
              "Stir-fry garlic in hot wok",
              "Add noodles, soy sauce, egg, cockles and veggies",
              "Toss quickly and serve hot"
            ]
          }
        ]
      },
      "snack": {
        "items": ["Keropok Lekor", "Chili Sauce"],
        "calories": 420,
        "price": 4.50,
        "title": "Terengganu Fish Crackers",
        "groceryList": [
          {"item": "Keropok Lekor", "quantity": "300g", "notes": "Sliced"},
          {"item": "Oil", "quantity": "500ml", "notes": "For deep frying"}
        ],
        "cookingInstructions": [
          {
            "title": "🐠 Keropok Lekor",
            "ingredients": ["Fish paste crackers", "Oil", "Chili sauce"],
            "instructions": [
              "Heat oil in deep fryer",
              "Fry keropok until crispy and golden brown",
              "Serve with chili sauce"
            ]
          }
        ]
      }
      }
    },
"keto": {
  "monday": {
    "breakfast": {
      "items": ["Scrambled Eggs with Avocado", "Bacon", "Bulletproof Coffee"],
      "calories": 580,
      "price": 13.90,
    },
    "lunch": {
      "items": ["Tuna Salad with Mayo", "Cucumber Slices", "Olives"],
      "calories": 420,
      "price": 10.50,
    },
    "dinner": {
      "items": ["Grilled Chicken Thighs", "Cauliflower Rice", "Spinach"],
      "calories": 490,
      "price": 15.20,
    },
    "snack": {
      "items": ["Cheese Cubes", "Almonds"],
      "calories": 310,
      "price": 7.80,
    }
  },
  "tuesday": {
    "breakfast": {
      "items": ["Coconut Flour Pancakes", "Berries", "Greek Yogurt"],
      "calories": 490,
      "price": 11.50,
    },
    "lunch": {
      "items": ["Keto Bowl", "Avocado", "Grilled Beef", "Eggs"],
      "calories": 560,
      "price": 16.90,
    },
    "dinner": {
      "items": ["Salmon Fillet", "Asparagus", "Lemon Butter Sauce"],
      "calories": 620,
      "price": 19.80,
    },
    "snack": {
      "items": ["Beef Jerky", "Macadamia Nuts"],
      "calories": 350,
      "price": 9.50,
    }
  },
  "wednesday": {
    "breakfast": {
      "items": ["Keto Smoothie", "Chia Seeds", "Coconut Flakes"],
      "calories": 410,
      "price": 10.20,
    },
    "lunch": {
      "items": ["Lettuce Wrap Burgers", "Cheddar Cheese", "Mayonnaise"],
      "calories": 550,
      "price": 14.30,
    },
    "dinner": {
      "items": ["Butter Chicken", "Cauliflower Rice", "Cucumber Raita"],
      "calories": 630,
      "price": 17.90,
    },
    "snack": {
      "items": ["Pork Rinds", "Guacamole"],
      "calories": 290,
      "price": 8.40,
    }
  },
  "thursday": {
    "breakfast": {
      "items": ["Avocado Baked Eggs", "Smoked Salmon", "Hollandaise"],
      "calories": 520,
      "price": 15.40,
    },
    "lunch": {
      "items": ["Greek Salad", "Feta Cheese", "Olive Oil", "Olives"],
      "calories": 480,
      "price": 12.90,
    },
    "dinner": {
      "items": ["Beef Steak", "Broccoli", "Mushroom Sauce"],
      "calories": 670,
      "price": 21.50,
    },
    "snack": {
      "items": ["Keto Fat Bombs", "Herbal Tea"],
      "calories": 280,
      "price": 9.30,
    }
  },
  "friday": {
    "breakfast": {
      "items": ["Crustless Quiche", "Spinach", "Goat Cheese"],
      "calories": 490,
      "price": 13.80,
    },
    "lunch": {
      "items": ["Chicken Caesar Salad", "Parmesan", "Keto Croutons"],
      "calories": 510,
      "price": 14.90,
    },
    "dinner": {
      "items": ["Zucchini Noodles", "Alfredo Sauce", "Grilled Shrimp"],
      "calories": 520,
      "price": 18.30,
    },
    "snack": {
      "items": ["Deviled Eggs", "Celery Sticks"],
      "calories": 240,
      "price": 6.90,
    }
  },
  "saturday": {
    "breakfast": {
      "items": ["Keto Waffles", "Sugar-free Syrup", "Strawberries"],
      "calories": 430,
      "price": 12.50,
    },
    "lunch": {
      "items": ["Cobb Salad", "Chicken", "Bacon", "Blue Cheese"],
      "calories": 580,
      "price": 16.40,
    },
    "dinner": {
      "items": ["Pork Chops", "Creamed Spinach", "Mushrooms"],
      "calories": 650,
      "price": 19.90,
    },
    "snack": {
      "items": ["Pepperoni Chips", "Cream Cheese Dip"],
      "calories": 320,
      "price": 8.90,
    }
  },
  "sunday": {
    "breakfast": {
      "items": ["Almond Flour Muffins", "Cream Cheese", "Berries"],
      "calories": 460,
      "price": 11.90,
    },
    "lunch": {
      "items": ["Cauliflower Mac & Cheese", "Bacon Bits", "Chives"],
      "calories": 510,
      "price": 13.50,
    },
    "dinner": {
      "items": ["Lamb Chops", "Mint Sauce", "Roasted Vegetables"],
      "calories": 690,
      "price": 24.90,
    },
    "snack": {
      "items": ["Chocolate Avocado Mousse", "Whipped Cream"],
      "calories": 290,
      "price": 9.90,
    }
  }
},
"vegan": {
  "monday": {
    "breakfast": {
      "items": ["Overnight Oats", "Chia Seeds", "Berries", "Almond Milk"],
      "calories": 420,
      "price": 9.50,
      "title": "Berry Chia Overnight Oats",
      "groceryList": [
        {"item": "Rolled Oats", "quantity": "1/2 cup", "notes": "Organic preferred"},
        {"item": "Chia Seeds", "quantity": "1 tbsp", "notes": "Rich in omega-3"}
      ],
      "cookingInstructions": [
        {
          "title": "🥣 Overnight Oats",
          "ingredients": ["1/2 cup rolled oats", "1 tbsp chia seeds", "3/4 cup almond milk"],
          "instructions": [
            "Mix oats and chia seeds in a jar",
            "Add almond milk and stir well",
            "Refrigerate overnight"
          ]
        }
      ]
    },
    "lunch": {
      "items": ["Buddha Bowl", "Quinoa", "Roasted Vegetables", "Tahini Sauce"],
      "calories": 520,
      "price": 13.50,
      "title": "Rainbow Buddha Bowl",
      "groceryList": [
        {"item": "Quinoa", "quantity": "1/2 cup uncooked", "notes": "Rinse well before cooking"},
        {"item": "Sweet Potato", "quantity": "1 medium", "notes": "Cut into 1-inch cubes"}
      ],
      "cookingInstructions": [
        {
          "title": "🍚 Quinoa Base",
          "ingredients": ["1/2 cup quinoa", "1 cup water", "Pinch of salt"],
          "instructions": [
            "Rinse quinoa thoroughly",
            "Combine quinoa, water, and salt in a pot",
            "Bring to a boil, then reduce heat and simmer for 15 minutes"
          ]
        }
      ]
    },
    "dinner": {
      "items": ["Lentil Curry", "Brown Rice", "Steamed Broccoli"],
      "calories": 580,
      "price": 12.20,
      "title": "Spiced Lentil Curry with Brown Rice",
      "groceryList": [
        {"item": "Red Lentils", "quantity": "1 cup", "notes": "Dry"},
        {"item": "Coconut Milk", "quantity": "1 can (400ml)", "notes": "Full fat preferred"}
      ],
      "cookingInstructions": [
        {
          "title": "🍛 Lentil Curry",
          "ingredients": ["1 cup red lentils", "1 can coconut milk", "1 tbsp curry powder"],
          "instructions": [
            "Rinse lentils until water runs clear",
            "In a pot, combine lentils, coconut milk, and 1 cup water",
            "Add curry powder and bring to a simmer"
          ]
        }
      ]
    },
    "snack": {
      "items": ["Hummus", "Carrot Sticks", "Cucumber Slices"],
      "calories": 220,
      "price": 6.50,
      "title": "Hummus with Fresh Vegetables",
      "groceryList": [
        {"item": "Chickpeas", "quantity": "1 can", "notes": "Drained and rinsed"},
        {"item": "Tahini", "quantity": "2 tbsp", "notes": "Stir well before using"}
      ],
      "cookingInstructions": [
        {
          "title": "🧆 Hummus",
          "ingredients": ["1 can chickpeas", "2 tbsp tahini", "1 clove garlic"],
          "instructions": [
            "Drain and rinse chickpeas",
            "Combine all ingredients in a food processor",
            "Blend until smooth, adding water if needed"
          ]
        }
      ]
    }
  },
  "tuesday": {
    "breakfast": {
      "items": ["Tofu Scramble", "Avocado Toast", "Fresh Fruit"],
      "calories": 450,
      "price": 10.20,
    },
    "lunch": {
      "items": ["Falafel Wrap", "Tahini Sauce", "Pickled Vegetables"],
      "calories": 540,
      "price": 11.90,
    },
    "dinner": {
      "items": ["Vegetable Stir-Fry", "Brown Rice Noodles", "Tofu"],
      "calories": 510,
      "price": 14.30,
    },
    "snack": {
      "items": ["Trail Mix", "Dried Fruit", "Nuts"],
      "calories": 320,
      "price": 7.80,
    }
  },
  "wednesday": {
    "breakfast": {
      "items": ["Smoothie Bowl", "Granola", "Banana", "Berries"],
      "calories": 410,
      "price": 11.50,
    },
    "lunch": {
      "items": ["Chickpea Salad", "Quinoa", "Lemon Dressing"],
      "calories": 480,
      "price": 12.40,
    },
    "dinner": {
      "items": ["Mushroom Risotto", "Truffle Oil", "Nutritional Yeast"],
      "calories": 570,
      "price": 16.80,
    },
    "snack": {
      "items": ["Energy Balls", "Dates", "Nuts", "Cacao"],
      "calories": 290,
      "price": 8.50,
    }
  },
  "thursday": {
    "breakfast": {
      "items": ["Avocado Toast", "Microgreens", "Nutritional Yeast"],
      "calories": 380,
      "price": 9.90,
    },
    "lunch": {
      "items": ["Lentil Soup", "Whole Grain Bread", "Side Salad"],
      "calories": 440,
      "price": 11.20,
    },
    "dinner": {
      "items": ["Vegan Burger", "Sweet Potato Fries", "Cashew Mayo"],
      "calories": 680,
      "price": 18.50,
    },
    "snack": {
      "items": ["Roasted Chickpeas", "Spices", "Olive Oil"],
      "calories": 220,
      "price": 5.80,
    }
  },
  "friday": {
    "breakfast": {
      "items": ["Chia Pudding", "Coconut Milk", "Mango", "Mint"],
      "calories": 390,
      "price": 10.80,
    },
    "lunch": {
      "items": ["Vegan Sushi", "Avocado", "Cucumber", "Pickled Ginger"],
      "calories": 520,
      "price": 15.90,
    },
    "dinner": {
      "items": ["Jackfruit Tacos", "Guacamole", "Pico de Gallo"],
      "calories": 560,
      "price": 16.20,
    },
    "snack": {
      "items": ["Green Smoothie", "Spinach", "Banana", "Almond Milk"],
      "calories": 240,
      "price": 7.50,
    }
  },
  "saturday": {
    "breakfast": {
      "items": ["Vegan Pancakes", "Maple Syrup", "Fresh Berries"],
      "calories": 490,
      "price": 12.80,
    },
    "lunch": {
      "items": ["Mediterranean Plate", "Hummus", "Tabbouleh", "Olives"],
      "calories": 510,
      "price": 14.50,
    },
    "dinner": {
      "items": ["Tempeh Stir-Fry", "Brown Rice", "Bok Choy"],
      "calories": 540,
      "price": 15.80,
    },
    "snack": {
      "items": ["Fruit Salad", "Coconut Yogurt", "Hemp Seeds"],
      "calories": 260,
      "price": 8.90,
    }
  },
  "sunday": {
    "breakfast": {
      "items": ["Vegan French Toast", "Banana", "Cinnamon"],
      "calories": 460,
      "price": 11.50,
    },
    "lunch": {
      "items": ["Quinoa Bowl", "Roasted Vegetables", "Tahini Dressing"],
      "calories": 520,
      "price": 13.80,
    },
    "dinner": {
      "items": ["Cauliflower Curry", "Basmati Rice", "Naan Bread"],
      "calories": 580,
      "price": 16.50,
    },
    "snack": {
      "items": ["Dark Chocolate", "Strawberries", "Mint Tea"],
      "calories": 230,
      "price": 9.20,
    }
  }
},
"vegetarian": {
  "monday": {
    "breakfast": {
      "items": ["Greek Yogurt", "Honey", "Granola", "Mixed Berries"],
      "calories": 420,
      "price": 9.80,
      "title": "Greek Yogurt Parfait",
      "groceryList": [
        {"item": "Greek Yogurt", "quantity": "1 cup", "notes": "Plain, full-fat preferred"},
        {"item": "Honey", "quantity": "1 tbsp", "notes": "Raw honey if available"}
      ],
      "cookingInstructions": [
        {
          "title": "🥣 Yogurt Parfait Assembly",
          "ingredients": ["1 cup Greek yogurt", "1 tbsp honey", "1/4 cup granola"],
          "instructions": [
            "Layer yogurt in a bowl",
            "Drizzle with honey",
            "Top with granola and fresh berries"
          ]
        }
      ]
    },
    "lunch": {
      "items": ["Spinach Feta Omelette", "Whole Grain Toast", "Fresh Fruit"],
      "calories": 480,
      "price": 11.50,
      "title": "Spinach & Feta Omelette",
      "groceryList": [
        {"item": "Eggs", "quantity": "3 large", "notes": "Free-range preferred"},
        {"item": "Fresh Spinach", "quantity": "1 cup", "notes": "Washed and dried"}
      ],
      "cookingInstructions": [
        {
          "title": "🍳 Spinach Feta Omelette",
          "ingredients": ["3 large eggs", "1 cup fresh spinach", "1/4 cup crumbled feta"],
          "instructions": [
            "Whisk eggs in a bowl",
            "Heat a non-stick pan over medium heat",
            "Add spinach and cook until wilted"
          ]
        }
      ]
    },
    "dinner": {
      "items": ["Eggplant Parmesan", "Garlic Bread", "Caesar Salad"],
      "calories": 620,
      "price": 16.80,
      "title": "Classic Eggplant Parmesan",
      "groceryList": [
        {"item": "Eggplant", "quantity": "1 medium", "notes": "Firm and glossy"},
        {"item": "Mozzarella Cheese", "quantity": "8 oz", "notes": "Fresh or shredded"}
      ],
      "cookingInstructions": [
        {
          "title": "🍆 Eggplant Parmesan",
          "ingredients": ["1 medium eggplant", "2 cups marinara sauce", "8 oz mozzarella"],
          "instructions": [
            "Slice eggplant into 1/2-inch rounds",
            "Salt slices and let sit for 30 minutes",
            "Pat dry and dredge in flour, egg, and breadcrumbs"
          ]
        }
      ]
    },
    "snack": {
      "items": ["Cheese and Crackers", "Grapes", "Almonds"],
      "calories": 310,
      "price": 8.50,
      "title": "Cheese & Crackers Plate",
      "groceryList": [
        {"item": "Assorted Cheeses", "quantity": "3 oz", "notes": "Cheddar, gouda, brie, etc."},
        {"item": "Whole Grain Crackers", "quantity": "1 package", "notes": "Low sodium preferred"}
      ],
      "cookingInstructions": [
        {
          "title": "🧀 Cheese Plate Assembly",
          "ingredients": ["3 oz assorted cheeses", "Whole grain crackers", "1 cup grapes"],
          "instructions": [
            "Arrange cheeses on a plate",
            "Add crackers and fresh grapes",
            "Serve at room temperature for best flavor"
          ]
        }
      ]
    }
  },
  "tuesday": {
    "breakfast": {
      "items": ["Cheese Omelette", "Hash Browns", "Fresh Orange Juice"],
      "calories": 520,
      "price": 12.50,
    },
    "lunch": {
      "items": ["Caprese Sandwich", "Mozzarella", "Tomato", "Basil"],
      "calories": 450,
      "price": 10.80,
    },
    "dinner": {
      "items": ["Vegetable Lasagna", "Garlic Bread", "Side Salad"],
      "calories": 680,
      "price": 17.90,
    },
    "snack": {
      "items": ["Yogurt Parfait", "Granola", "Honey", "Berries"],
      "calories": 280,
      "price": 7.50,
    }
  },
  "wednesday": {
    "breakfast": {
      "items": ["Pancakes", "Maple Syrup", "Fresh Strawberries"],
      "calories": 510,
      "price": 11.20,
    },
    "lunch": {
      "items": ["Vegetable Quiche", "Green Salad", "Balsamic Dressing"],
      "calories": 490,
      "price": 13.50,
    },
    "dinner": {
      "items": ["Margherita Pizza", "Caesar Salad", "Garlic Knots"],
      "calories": 720,
      "price": 18.90,
    },
    "snack": {
      "items": ["Vegetable Sticks", "Hummus", "Pita Chips"],
      "calories": 240,
      "price": 6.80,
    }
  },
  "thursday": {
    "breakfast": {
      "items": ["Egg and Cheese Sandwich", "Hash Browns", "Coffee"],
      "calories": 490,
      "price": 10.90,
    },
    "lunch": {
      "items": ["Mushroom Risotto", "Parmesan Cheese", "Asparagus"],
      "calories": 560,
      "price": 14.80,
    },
    "dinner": {
      "items": ["Eggplant Curry", "Naan Bread", "Raita"],
      "calories": 610,
      "price": 16.50,
    },
    "snack": {
      "items": ["Fruit and Cheese Plate", "Crackers", "Honey"],
      "calories": 320,
      "price": 9.20,
    }
  },
  "friday": {
    "breakfast": {
      "items": ["Vegetarian Breakfast Burrito", "Salsa", "Fresh Fruit"],
      "calories": 540,
      "price": 12.80,
    },
    "lunch": {
      "items": ["Greek Salad", "Feta Cheese", "Pita Bread", "Hummus"],
      "calories": 470,
      "price": 13.20,
    },
    "dinner": {
      "items": ["Spinach and Ricotta Cannelloni", "Garlic Bread", "Red Wine"],
      "calories": 690,
      "price": 19.50,
    },
    "snack": {
      "items": ["Cottage Cheese", "Pineapple", "Walnuts"],
      "calories": 260,
      "price": 7.80,
    }
  },
  "saturday": {
    "breakfast": {
      "items": ["Belgian Waffles", "Fresh Berries", "Whipped Cream"],
      "calories": 580,
      "price": 14.50,
    },
    "lunch": {
      "items": ["Tomato Soup", "Grilled Cheese Sandwich", "Apple Slices"],
      "calories": 520,
      "price": 12.90,
    },
    "dinner": {
      "items": ["Stuffed Bell Peppers", "Rice", "Cheese", "Side Salad"],
      "calories": 580,
      "price": 15.80,
    },
    "snack": {
      "items": ["Greek Yogurt", "Honey", "Sliced Almonds"],
      "calories": 240,
      "price": 6.90,
    }
  },
  "sunday": {
    "breakfast": {
      "items": ["Eggs Benedict", "English Muffin", "Hollandaise", "Fresh Fruit"],
      "calories": 620,
      "price": 16.90,
    },
    "lunch": {
      "items": ["Mediterranean Platter", "Falafel", "Hummus", "Pita"],
      "calories": 580,
      "price": 15.80,
    },
    "dinner": {
      "items": ["Mushroom Wellington", "Roasted Vegetables", "Gravy"],
      "calories": 650,
      "price": 18.90,
    },
    "snack": {
      "items": ["Chocolate Mousse", "Raspberries", "Mint"],
      "calories": 310,
      "price": 8.90,
    }
  }
},
"dairy-free": {
  "monday": {
    "breakfast": {
      "items": ["Coconut Yogurt", "Fresh Fruit", "Granola", "Almond Milk"],
      "calories": 410,
      "price": 10.80,
      "title": "Coconut Yogurt Parfait",
      "groceryList": [
        {"item": "Coconut Yogurt", "quantity": "1 cup", "notes": "Non-dairy"},
        {"item": "Granola", "quantity": "1/2 cup", "notes": "Dairy-free variety"}
      ],
      "cookingInstructions": [
        {
          "title": "🥥 Coconut Yogurt Parfait",
          "ingredients": ["1 cup coconut yogurt", "1/2 cup granola", "1/2 cup fresh berries"],
          "instructions": [
            "Layer coconut yogurt in a bowl",
            "Add sliced fresh fruit",
            "Top with dairy-free granola"
          ]
        }
      ]
    },
    "lunch": {
      "items": ["Avocado Toast", "Smoked Salmon", "Lemon", "Capers"],
      "calories": 480,
      "price": 13.50,
      "title": "Salmon Avocado Toast",
      "groceryList": [
        {"item": "Avocado", "quantity": "1 ripe", "notes": "Medium size"},
        {"item": "Smoked Salmon", "quantity": "4 oz", "notes": "Wild-caught preferred"}
      ],
      "cookingInstructions": [
        {
          "title": "🥑 Salmon Avocado Toast",
          "ingredients": ["2 slices whole grain bread", "1 ripe avocado", "4 oz smoked salmon"],
          "instructions": [
            "Toast bread until golden brown",
            "Mash avocado and spread on toast",
            "Top with smoked salmon, capers, and a squeeze of lemon"
          ]
        }
      ]
    },
    "dinner": {
      "items": ["Grilled Chicken", "Roasted Sweet Potatoes", "Steamed Broccoli"],
      "calories": 580,
      "price": 15.90,
      "title": "Grilled Chicken with Vegetables",
      "groceryList": [
        {"item": "Chicken Breast", "quantity": "8 oz", "notes": "Boneless, skinless"},
        {"item": "Sweet Potatoes", "quantity": "2 medium", "notes": "Washed and dried"}
      ],
      "cookingInstructions": [
        {
          "title": "🍗 Grilled Chicken",
          "ingredients": ["8 oz chicken breast", "2 tbsp olive oil", "Herbs and spices"],
          "instructions": [
            "Season chicken breast with herbs, spices, and olive oil",
            "Grill for 6-7 minutes per side until cooked through",
            "Let rest for 5 minutes before slicing"
          ]
        }
      ]
    },
    "snack": {
      "items": ["Almond Butter", "Apple Slices", "Cinnamon"],
      "calories": 260,
      "price": 7.50,
      "title": "Apple with Almond Butter",
      "groceryList": [
        {"item": "Almond Butter", "quantity": "2 tbsp", "notes": "No added sugar"},
        {"item": "Apples", "quantity": "2 medium", "notes": "Any variety"}
      ],
      "cookingInstructions": [
        {
          "title": "🍎 Apple with Almond Butter",
          "ingredients": ["1 apple", "2 tbsp almond butter", "1/4 tsp cinnamon"],
          "instructions": [
            "Wash and slice apple into wedges",
            "Serve with almond butter for dipping",
            "Sprinkle with cinnamon if desired"
          ]
        }
      ]
    }
  },
  "tuesday": {
    "breakfast": {
      "items": ["Avocado Toast", "Fried Egg", "Hot Sauce"],
      "calories": 440,
      "price": 9.90,
    },
    "lunch": {
      "items": ["Quinoa Salad", "Grilled Chicken", "Olive Oil Dressing"],
      "calories": 520,
      "price": 14.50,
    },
    "dinner": {
      "items": ["Grilled Salmon", "Roasted Vegetables", "Lemon Herb Sauce"],
      "calories": 610,
      "price": 18.90,
    },
    "snack": {
      "items": ["Trail Mix", "Dried Fruit", "Dark Chocolate Chips"],
      "calories": 310,
      "price": 8.50,
    }
  },
  "wednesday": {
    "breakfast": {
      "items": ["Chia Pudding", "Almond Milk", "Berries", "Honey"],
      "calories": 380,
      "price": 10.20,
    },
    "lunch": {
      "items": ["Tuna Salad", "Lettuce Wraps", "Olive Oil", "Lemon"],
      "calories": 450,
      "price": 13.80,
    },
    "dinner": {
      "items": ["Beef Stir-Fry", "Brown Rice", "Mixed Vegetables"],
      "calories": 580,
      "price": 16.50,
    },
    "snack": {
      "items": ["Rice Cakes", "Almond Butter", "Sliced Banana"],
      "calories": 280,
      "price": 7.20,
    }
  },
  "thursday": {
    "breakfast": {
      "items": ["Smoothie Bowl", "Coconut Milk", "Frozen Berries", "Banana"],
      "calories": 420,
      "price": 11.50,
    },
    "lunch": {
      "items": ["Chicken Lettuce Wraps", "Asian Sauce", "Rice Noodles"],
      "calories": 490,
      "price": 14.80,
    },
    "dinner": {
      "items": ["Roast Turkey", "Sweet Potatoes", "Cranberry Sauce"],
      "calories": 620,
      "price": 17.90,
    },
    "snack": {
      "items": ["Dairy-Free Chocolate", "Coconut Flakes", "Raspberries"],
      "calories": 290,
      "price": 8.90,
    }
  },
  "friday": {
    "breakfast": {
      "items": ["Oatmeal", "Almond Milk", "Sliced Banana", "Cinnamon"],
      "calories": 390,
      "price": 8.50,
    },
    "lunch": {
      "items": ["Veggie Sushi Rolls", "Wasabi", "Pickled Ginger", "Soy Sauce"],
      "calories": 420,
      "price": 15.90,
    },
    "dinner": {
      "items": ["Coconut Curry Chicken", "Jasmine Rice", "Steamed Vegetables"],
      "calories": 590,
      "price": 16.80,
    },
    "snack": {
      "items": ["Dried Mango", "Cashews", "Green Tea"],
      "calories": 260,
      "price": 7.90,
    }
  },
  "saturday": {
    "breakfast": {
      "items": ["Dairy-Free Pancakes", "Maple Syrup", "Fresh Berries"],
      "calories": 510,
      "price": 12.50,
    },
    "lunch": {
      "items": ["Grilled Chicken Salad", "Avocado", "Balsamic Vinaigrette"],
      "calories": 480,
      "price": 14.90,
    },
    "dinner": {
      "items": ["Lamb Chops", "Mashed Potatoes", "Mint Sauce"],
      "calories": 680,
      "price": 22.50,
    },
    "snack": {
      "items": ["Roasted Chickpeas", "Olive Oil", "Sea Salt"],
      "calories": 240,
      "price": 6.20,
    }
  },
  "sunday": {
    "breakfast": {
      "items": ["Avocado Toast", "Poached Eggs", "Hot Sauce"],
      "calories": 450,
      "price": 11.20,
    },
    "lunch": {
      "items": ["BBQ Pulled Pork", "Sweet Potato Fries", "Coleslaw"],
      "calories": 680,
      "price": 16.90,
    },
    "dinner": {
      "items": ["Roast Chicken", "Herb Roasted Potatoes", "Grilled Asparagus"],
      "calories": 620,
      "price": 18.50,
    },
    "snack": {
      "items": ["Fruit Salad", "Mint", "Lime Juice"],
      "calories": 190,
      "price": 7.80,
    }
  }
},
"gluten-free": {
  "monday": {
    "breakfast": {
      "items": ["Gluten-Free Oatmeal", "Fresh Berries", "Honey", "Cinnamon"],
      "calories": 390,
      "price": 9.80,
      "title": "Berry Cinnamon Oatmeal",
      "groceryList": [
        {"item": "Certified Gluten-Free Oats", "quantity": "1/2 cup", "notes": "Check for certification"},
        {"item": "Mixed Berries", "quantity": "1/2 cup", "notes": "Fresh or frozen"}
      ],
      "cookingInstructions": [
        {
          "title": "🥣 Gluten-Free Oatmeal",
          "ingredients": ["1/2 cup certified gluten-free oats", "1 cup water or milk", "1/2 cup berries"],
          "instructions": [
            "Combine oats and liquid in a pot",
            "Bring to a boil, then reduce heat and simmer for 5 minutes",
            "Top with berries, honey, and cinnamon"
          ]
        }
      ]
    },
    "lunch": {
      "items": ["Grilled Chicken Salad", "Quinoa", "Avocado", "Lemon Dressing"],
      "calories": 510,
      "price": 14.50,
      "title": "Chicken Quinoa Salad Bowl",
      "groceryList": [
        {"item": "Chicken Breast", "quantity": "6 oz", "notes": "Boneless, skinless"},
        {"item": "Quinoa", "quantity": "1/2 cup uncooked", "notes": "Rinse before cooking"}
      ],
      "cookingInstructions": [
        {
          "title": "🥗 Chicken Quinoa Salad",
          "ingredients": ["6 oz grilled chicken breast", "1/2 cup cooked quinoa", "Mixed greens"],
          "instructions": [
            "Cook quinoa according to package instructions",
            "Grill chicken until fully cooked",
            "Combine with mixed greens and top with lemon dressing"
          ]
        }
      ]
    },
    "dinner": {
      "items": ["Grilled Salmon", "Wild Rice", "Roasted Vegetables"],
      "calories": 620,
      "price": 18.90,
      "title": "Grilled Salmon with Wild Rice",
      "groceryList": [
        {"item": "Salmon Fillet", "quantity": "6 oz", "notes": "Wild-caught preferred"},
        {"item": "Wild Rice", "quantity": "1/2 cup uncooked", "notes": "Check for gluten-free certification"}
      ],
      "cookingInstructions": [
        {
          "title": "🐟 Grilled Salmon",
          "ingredients": ["6 oz salmon fillet", "1 tbsp olive oil", "Lemon juice"],
          "instructions": [
            "Preheat grill to medium-high heat",
            "Brush salmon with olive oil and season",
            "Grill for 4-5 minutes per side"
          ]
        }
      ]
    },
    "snack": {
      "items": ["Rice Crackers", "Cheese", "Grapes"],
      "calories": 280,
      "price": 7.50,
      "title": "Rice Crackers with Cheese",
      "groceryList": [
        {"item": "Gluten-Free Rice Crackers", "quantity": "10-12 crackers", "notes": "Check for certification"},
        {"item": "Cheese", "quantity": "2 oz", "notes": "Cheddar or your preference"}
      ],
      "cookingInstructions": [
        {
          "title": "🧀 Rice Crackers & Cheese Plate",
          "ingredients": ["10-12 gluten-free rice crackers", "2 oz cheese", "1/2 cup grapes"],
          "instructions": [
            "Arrange crackers on a plate",
            "Add cheese slices or cubes",
            "Serve with fresh grapes on the side"
          ]
        }
      ]
    }
  },
  "tuesday": {
    "breakfast": {
      "items": ["Gluten-Free Toast", "Avocado", "Poached Eggs"],
      "calories": 450,
      "price": 11.20,
    },
    "lunch": {
      "items": ["Taco Salad", "Ground Beef", "Beans", "Corn Chips"],
      "calories": 580,
      "price": 15.90,
    },
    "dinner": {
      "items": ["Grilled Pork Chops", "Mashed Potatoes", "Green Beans"],
      "calories": 620,
      "price": 17.50,
    },
    "snack": {
      "items": ["Yogurt", "Gluten-Free Granola", "Honey"],
      "calories": 290,
      "price": 8.20,
    }
  },
  "wednesday": {
    "breakfast": {
      "items": ["Gluten-Free Pancakes", "Maple Syrup", "Fresh Fruit"],
      "calories": 490,
      "price": 12.80,
    },
    "lunch": {
      "items": ["Rice Bowl", "Grilled Chicken", "Avocado", "Black Beans"],
      "calories": 520,
      "price": 14.50,
    },
    "dinner": {
      "items": ["Beef Stir-Fry", "Rice Noodles", "Mixed Vegetables"],
      "calories": 580,
      "price": 16.90,
    },
    "snack": {
      "items": ["Corn Tortilla Chips", "Guacamole", "Salsa"],
      "calories": 320,
      "price": 8.50,
    }
  },
  "thursday": {
    "breakfast": {
      "items": ["Smoothie Bowl", "Gluten-Free Granola", "Sliced Banana"],
      "calories": 410,
      "price": 10.90,
    },
    "lunch": {
      "items": ["Baked Potato", "Chili", "Cheese", "Sour Cream"],
      "calories": 580,
      "price": 13.50,
    },
    "dinner": {
      "items": ["Grilled Shrimp", "Quinoa", "Roasted Vegetables"],
      "calories": 520,
      "price": 18.20,
    },
    "snack": {
      "items": ["Rice Cakes", "Almond Butter", "Honey"],
      "calories": 270,
      "price": 7.50,
    }
  },
  "friday": {
    "breakfast": {
      "items": ["Frittata", "Cheese", "Spinach", "Mushrooms"],
      "calories": 480,
      "price": 12.50,
    },
    "lunch": {
      "items": ["Sushi", "Gluten-Free Soy Sauce", "Wasabi", "Ginger"],
      "calories": 520,
      "price": 16.90,
    },
    "dinner": {
      "items": ["Roast Chicken", "Potatoes", "Carrots", "Gravy"],
      "calories": 650,
      "price": 17.80,
    },
    "snack": {
      "items": ["Popcorn", "Sea Salt", "Olive Oil"],
      "calories": 220,
      "price": 5.90,
    }
  },
  "saturday": {
    "breakfast": {
      "items": ["Gluten-Free Waffles", "Fresh Berries", "Whipped Cream"],
      "calories": 520,
      "price": 13.80,
    },
    "lunch": {
      "items": ["Cobb Salad", "Chicken", "Bacon", "Hard-Boiled Eggs"],
      "calories": 580,
      "price": 15.90,
    },
    "dinner": {
      "items": ["Steak", "Baked Potato", "Asparagus", "Garlic Butter"],
      "calories": 710,
      "price": 24.50,
    },
    "snack": {
      "items": ["Mixed Nuts", "Dried Fruits", "Dark Chocolate"],
      "calories": 320,
      "price": 9.50,
    }
  },
  "sunday": {
    "breakfast": {
      "items": ["Gluten-Free Bagel", "Cream Cheese", "Smoked Salmon"],
      "calories": 510,
      "price": 14.80,
    },
    "lunch": {
      "items": ["Corn Tortilla Tacos", "Grilled Fish", "Cabbage Slaw"],
      "calories": 480,
      "price": 16.50,
    },
    "dinner": {
      "items": ["Lamb Chops", "Herb Roasted Potatoes", "Mint Sauce"],
      "calories": 690,
      "price": 22.90,
    },
    "snack": {
      "items": ["Gluten-Free Cookies", "Milk", "Fresh Fruit"],
      "calories": 310,
      "price": 8.90,
    }
  }
}  
};
function testMealPlan(planType, day) {
window.updateMeals(planType, day);
}


document.addEventListener('DOMContentLoaded', function() {
  
  // Fix day tabs
  const dayTabs = document.querySelectorAll('.day-tab');
  
  // one day is active
  dayTabs.forEach(tab => tab.classList.remove('active'));
  const mondayTab = document.querySelector('.day-tab[data-day="monday"]');
  if (mondayTab) mondayTab.classList.add('active');
  
  // Fix plan cards
  const planCards = document.querySelectorAll('.plan-card');
  
  // Make updateMeals global 
  window.fixDetailButtons = fixDetailButtons;
  
}); 

// update meals based on plan type and day
window.updateMeals = function(planType, day) {
  
  // Check if we have data
  if (!window.mealPlans) {
      return;
  }
  
  if (!window.mealPlans[planType]) {
      return;
  }
  
  let usedDay = day;
  let usingFallback = false;
  if (!window.mealPlans[planType][day]) {
      usingFallback = true;
      
      // Try to get available days 
      const availableDays = Object.keys(window.mealPlans[planType]);
      if (availableDays.length > 0) {
          // Use first available day 
          usedDay = availableDays[0];
          
          // Show fallback notice 
          const fallbackNotice = document.createElement('div');
          fallbackNotice.className = 'fallback-notice';
          fallbackNotice.style.textAlign = 'center';
          fallbackNotice.style.padding = '10px';
          fallbackNotice.style.margin = '10px 0';
          fallbackNotice.style.backgroundColor = '#fff3cd';
          fallbackNotice.style.color = '#856404';
          fallbackNotice.style.borderRadius = '5px';
          fallbackNotice.innerHTML = `<i class="fas fa-info-circle"></i> Showing sample meal plan from ${usedDay} (data for ${day} not available yet)`;
          
          const mealPlanSection = document.getElementById('meal-plan-section');
          const dayTabs = document.querySelector('.day-tabs');
          
          const existingNotice = document.querySelector('.fallback-notice');
          if (existingNotice) {
              existingNotice.remove();
          }
          
          if (mealPlanSection && dayTabs) {
              mealPlanSection.insertBefore(fallbackNotice, dayTabs.nextSibling);
          }
      } else {
          return;
      }
  } else {
      const existingNotice = document.querySelector('.fallback-notice');
      if (existingNotice) {
          existingNotice.remove();
      }
  }
  
  const meals = window.mealPlans[planType][usedDay];
  
  const mealElements = document.querySelectorAll('.meal');
  
  // Define meal icons
  const mealIcons = {
      'breakfast': '<i class="fas fa-coffee"></i>',
      'lunch': '<i class="fas fa-utensils"></i>',
      'dinner': '<i class="fas fa-moon"></i>',
      'snack': '<i class="fas fa-apple-alt"></i>'
  };
  
  const mealLabels = {
      'breakfast': 'Breakfast',
      'lunch': 'Lunch',
      'dinner': 'Dinner',
      'snack': 'Snacks'
  };
  
  // Update each meal (breakfast, lunch, dinner, snack)
  mealElements.forEach((mealElement, index) => {
      const mealType = ['breakfast', 'lunch', 'dinner', 'snack'][index];
      const mealData = meals[mealType];
      
      if (!mealData) {
          return;
      }
      
      // Update meal icon
      const mealIcon = mealElement.querySelector('.meal-icon');
      if (mealIcon) {
          mealIcon.innerHTML = mealIcons[mealType];
      }
      
      // Update meal type label    
      const mealTypeElement = mealElement.querySelector('.meal-type');
      if (mealTypeElement) {
          const label = mealLabels[mealType] || mealType.charAt(0).toUpperCase() + mealType.slice(1);
          mealTypeElement.textContent = label;
      }
      
      // Update meal items
      const mealItemsContainer = mealElement.querySelector('.meal-items');
      if (mealItemsContainer && mealData.items) {
          // Clear previous items
          mealItemsContainer.innerHTML = '';
          
          if (Array.isArray(mealData.items)) {
              mealData.items.forEach(item => {
                  const itemDiv = document.createElement('div');
                  itemDiv.className = 'meal-item';
                  itemDiv.textContent = typeof item === 'string' ? item : (item.name || "Unknown item");
                  mealItemsContainer.appendChild(itemDiv);
              });
          }
      }
      
      // Update meal details 
      const mealDetails = mealElement.querySelector('.meal-details');
      if (mealDetails) {
          mealDetails.innerHTML = `
              <span>${mealData.calories} calories</span>
              <span>RM${mealData.price.toFixed(2)}</span>
          `;
      }
      
      // Update details button
      const detailsBtn = mealElement.querySelector('.details-btn');
      if (detailsBtn) {
          detailsBtn.onclick = function() {
              updateFoodDetailsModal(planType, day, mealType);
              document.getElementById('foodDetailsModal').classList.add('active');
          };
      }
  });
  
  // Update daily summary
  const totalCalories = Object.values(meals).reduce((sum, meal) => sum + meal.calories, 0);
  const totalPrice = Object.values(meals).reduce((sum, meal) => sum + meal.price, 0);
  
  const dailySummary = document.querySelector('.daily-summary');
  if (dailySummary) {
      const caloriesSummary = dailySummary.querySelector('.summary-item:first-child .summary-value');
      const priceSummary = dailySummary.querySelector('.summary-item:last-child .summary-value');
      
      if (caloriesSummary) caloriesSummary.textContent = `${totalCalories} calories`;
      if (priceSummary) priceSummary.textContent = `RM${totalPrice.toFixed(2)}`;
  }
} 

window.fixDetailButtons = function(planType, day) {
  const mealElements = document.querySelectorAll('.meal');
  
  mealElements.forEach((mealElement, index) => {
      const mealType = ['breakfast', 'lunch', 'dinner', 'snack'][index];
      const detailsBtn = mealElement.querySelector('.details-btn');
      
      if (detailsBtn) {
          detailsBtn.onclick = function() {
              if (typeof updateFoodDetailsModal === 'function') {
                  updateFoodDetailsModal(planType, day, mealType);
                  document.getElementById('foodDetailsModal').classList.add('active');
              }
          };
      }
  });
}

// update food details modal
window.updateFoodDetailsModal = function(planType, day, mealType) {

  const plansData = window.mealPlans;
  
  if (!plansData) {
      return;
  }
  
  let usedDay = day;
  if (!plansData[planType] || !plansData[planType][day]) {
      const availableDays = plansData[planType] ? Object.keys(plansData[planType]) : [];
      if (availableDays.length > 0) {
          usedDay = availableDays[0];
      } else {
          return;
      }
  }
  
  const mealData = plansData[planType][usedDay][mealType];
  const foodDetailsModal = document.getElementById('foodDetailsModal');
  
  if (!foodDetailsModal) {
      return;
  }
  
  // Update modal title
  const modalTitle = foodDetailsModal.querySelector('.modal-title');
  if (modalTitle) {
      modalTitle.textContent = mealData.title || `${mealType.charAt(0).toUpperCase() + mealType.slice(1)} Details`;
  }
  
  // Update nutrition information
  const nutritionTable = foodDetailsModal.querySelector('.nutrition-table tbody');
  if (nutritionTable) {
      nutritionTable.innerHTML = '';
      
      let totalCalories = 0;
      let totalPrice = 0;
      
      // Add each item to the table
      mealData.items.forEach(item => {
          const itemName = typeof item === 'string' ? item : item.name;
          const itemCalories = typeof item === 'object' && item.calories ? item.calories : Math.round(mealData.calories / mealData.items.length);
          const itemPrice = typeof item === 'object' && item.price ? item.price : Number((mealData.price / mealData.items.length).toFixed(2));
          
          totalCalories += itemCalories;
          totalPrice += itemPrice;
          
          const row = document.createElement('tr');
          row.innerHTML = `
              <td>${itemName}</td>
              <td>1 serving</td>
              <td>${itemCalories} kcal</td>
              <td>RM ${itemPrice.toFixed(2)}</td>
          `;
          nutritionTable.appendChild(row);
      });
      
      // Add total row
      const totalRow = document.createElement('tr');
      totalRow.className = 'total-row';
      totalRow.innerHTML = `
          <td><strong>Total</strong></td>
          <td></td>
          <td><strong>${totalCalories} kcal</strong></td>
          <td><strong>RM ${totalPrice.toFixed(2)}</strong></td>
      `;
      nutritionTable.appendChild(totalRow);
  }
  
  // grocery list
  const groceryTable = foodDetailsModal.querySelector('.grocery-table tbody');
  if (groceryTable) {
      groceryTable.innerHTML = '';
      
      if (mealData.groceryList && Array.isArray(mealData.groceryList)) {
          mealData.groceryList.forEach(grocery => {
              const row = document.createElement('tr');
              row.innerHTML = `
                  <td>${grocery.item}</td>
                  <td>${grocery.quantity}</td>
                  <td>${grocery.notes || ''}</td>
              `;
              groceryTable.appendChild(row);
          });
      } else {
          // Create default grocery items based on meal items
          mealData.items.forEach(item => {
              const itemName = typeof item === 'string' ? item : item.name;
              const row = document.createElement('tr');
              row.innerHTML = `
                  <td>${itemName}</td>
                  <td>As needed</td>
                  <td>Purchase fresh</td>
              `;
              groceryTable.appendChild(row);
          });
      }
  }
  
  // cooking instructions
  const cookingSection = foodDetailsModal.querySelector('.food-details-section');
  if (cookingSection) {
      cookingSection.innerHTML = '<h4 class="section-title">Cooking Instructions</h4>';
      
      if (mealData.cookingInstructions && Array.isArray(mealData.cookingInstructions)) {
          mealData.cookingInstructions.forEach(recipe => {
              const cookingItem = document.createElement('div');
              cookingItem.className = 'cooking-item';
              
              let ingredientsList = '';
              if (Array.isArray(recipe.ingredients)) {
                  ingredientsList = recipe.ingredients.map(ing => `<li>${ing}</li>`).join('');
              }
              
              let instructionsList = '';
              if (Array.isArray(recipe.instructions)) {
                  instructionsList = recipe.instructions.map(inst => `<li>${inst}</li>`).join('');
              }
              
              cookingItem.innerHTML = `
                  <h6>${recipe.title || 'Recipe'}</h6>
                  <p><strong>Ingredients:</strong></p>
                  <ul>${ingredientsList}</ul>
                  <p><strong>Instructions:</strong></p>
                  <ol>${instructionsList}</ol>
              `;
              
              cookingSection.appendChild(cookingItem);
          });
      } else {
          // a simple instruction if none provided
          const cookingItem = document.createElement('div');
          cookingItem.className = 'cooking-item';
          cookingItem.innerHTML = `
              <h6>Basic Preparation</h6>
              <p>No specific cooking instructions provided for this meal.</p>
              <p>Prepare ingredients according to your preference or follow standard recipes for each item.</p>
          `;
          cookingSection.appendChild(cookingItem);
      }
  }
}

window.mealPlans = mealPlans;

// event listeners for plan selection
document.addEventListener('DOMContentLoaded', function() {
  
  const planCards = document.querySelectorAll('.plan-card');
  const mealPlanSection = document.getElementById('meal-plan-section');
  const instructionsText = document.getElementById('plan-instructions');
  
  planCards.forEach((card, index) => {
      card.addEventListener('click', function() {
          planCards.forEach(c => c.classList.remove('active'));
          
          this.classList.add('active');
          
          const planType = this.getAttribute('data-plan');
          
          if (instructionsText) {
              instructionsText.style.display = 'none';
          }
          
          if (mealPlanSection) {
              mealPlanSection.style.display = 'block';
          }
          
          loadMealPlan(planType, 'monday'); 
      });
  });
  
  // Add event listeners for day tabs
  const dayTabs = document.querySelectorAll('.day-tab');
  
  dayTabs.forEach((tab, index) => {
      tab.addEventListener('click', function() {
          dayTabs.forEach(t => t.classList.remove('active'));
          
          this.classList.add('active');
          
          const activePlanCard = document.querySelector('.plan-card.active');
          if (activePlanCard) {
              const planType = activePlanCard.getAttribute('data-plan');
              const day = this.getAttribute('data-day');
              loadMealPlan(planType, day);
          }
      });
  });
  
  // event listeners for details buttons
  document.addEventListener('click', function(e) {
      if (e.target.classList.contains('details-btn')) {
          const meal = e.target.closest('.meal');
          const mealType = meal.querySelector('.meal-type').textContent.toLowerCase();
          
          // Get active plan and day
          const activePlanCard = document.querySelector('.plan-card.active');
          const activeDayTab = document.querySelector('.day-tab.active');
          
          if (activePlanCard && activeDayTab) {
              const planType = activePlanCard.getAttribute('data-plan');
              const day = activeDayTab.getAttribute('data-day');
              showFoodDetails(planType, day, mealType);
          }
      }
  });
  
});

function loadMealPlan(planType, day) {
  
  if (!window.mealPlans) {
      return;
  }
  
  if (!window.mealPlans[planType]) {
      return;
  }
  
  if (!window.mealPlans[planType][day]) {
      return;
  }
  
  const planData = window.mealPlans[planType][day];
  
  const meals = document.querySelectorAll('.meal');
  
  meals.forEach((meal, index) => {
      const mealType = meal.querySelector('.meal-type').textContent.toLowerCase();
      const mealItems = meal.querySelector('.meal-items');
      const mealDetails = meal.querySelector('.meal-details');
      
      // Clear existing content
      mealItems.innerHTML = '';
      
      // Get meal data
      let mealData;
      switch(mealType) {
          case 'breakfast':
              mealData = planData.breakfast;
              break;
          case 'lunch':
              mealData = planData.lunch;
              break;
          case 'dinner':
              mealData = planData.dinner;
              break;
          case 'snacks':
              mealData = planData.snack;
              break;
      }
      
      if (mealData && mealData.items) {
          // Add meal items
          mealData.items.forEach((item, itemIndex) => {
              const itemName = typeof item === 'string' ? item : item.name;
              
              const itemElement = document.createElement('div');
              itemElement.className = 'meal-item';
              itemElement.textContent = itemName;
              mealItems.appendChild(itemElement);
          });
          
          // Update meal details
          if (mealDetails) {
              const caloriesSpan = mealDetails.querySelector('span:first-child');
              const priceSpan = mealDetails.querySelector('span:last-child');
              
              if (caloriesSpan) {
                  caloriesSpan.textContent = `${mealData.calories} calories`;
              }
              if (priceSpan) {
                  priceSpan.textContent = `RM${mealData.price.toFixed(2)}`;
              }
          }
      }
  });
  
  // Update daily summary
  updateDailySummary(planData);
}

function updateDailySummary(planData) {
  
  const dailySummary = document.querySelector('.daily-summary');
  if (!dailySummary) {
      return;
  }
  
  let totalCalories = 0;
  let totalPrice = 0;
  
  // Calculate totals from all meals
  ['breakfast', 'lunch', 'dinner', 'snack'].forEach(mealType => {
      const mealData = planData[mealType];
      if (mealData) {
          totalCalories += mealData.calories;
          totalPrice += mealData.price;
      }
  });
  
  // Update summary values
  const summaryValues = dailySummary.querySelectorAll('.summary-value');
  
  if (summaryValues.length >= 2) {
      summaryValues[0].textContent = `${totalCalories} calories`;
      summaryValues[1].textContent = `RM${totalPrice.toFixed(2)}`;
  }
}

function showFoodDetails(planType, day, mealType) {
  
  if (!window.mealPlans || !window.mealPlans[planType] || !window.mealPlans[planType][day]) {
      return;
  }
  
  const planData = window.mealPlans[planType][day];
  const mealData = planData[mealType];
  
  if (!mealData) {
      return;
  }
  
  // Update modal content with meal data
  const modal = document.getElementById('foodDetailsModal');
  const modalTitle = modal.querySelector('.modal-title');
  const nutritionTable = modal.querySelector('.nutrition-table tbody');
  const groceryTable = modal.querySelector('.grocery-table tbody');
  
  modalTitle.textContent = `${mealType.charAt(0).toUpperCase() + mealType.slice(1)} Details`;

  if (nutritionTable && mealData.items) {
      nutritionTable.innerHTML = '';
      
      mealData.items.forEach(item => {
          const itemName = typeof item === 'string' ? item : item.name;
          const calories = Math.round(mealData.calories / mealData.items.length);
          const price = (mealData.price / mealData.items.length).toFixed(2);
          
          const row = nutritionTable.insertRow();
          row.innerHTML = `
              <td>${itemName}</td>
              <td>1 serving</td>
              <td>${calories} kcal</td>
              <td>RM ${price}</td>
          `;
      });
      
      // Add total row
      const totalRow = nutritionTable.insertRow();
      totalRow.className = 'total-row';
      totalRow.innerHTML = `
          <td><strong>Total</strong></td>
          <td></td>
          <td><strong>${mealData.calories} kcal</strong></td>
          <td><strong>RM ${mealData.price.toFixed(2)}</strong></td>
      `;
  }
  
  // Update grocery table
  if (groceryTable && mealData.groceryList) {
      groceryTable.innerHTML = '';
      
      mealData.groceryList.forEach(item => {
          const row = groceryTable.insertRow();
          row.innerHTML = `
              <td>${item.item}</td>
              <td>${item.quantity}</td>
              <td>${item.notes || ''}</td>
          `;
      });
  }
  
  // Show modal
  modal.classList.add('active');
}
