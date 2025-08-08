<!--
Programmer Name : Sim Tian (TP077056), Siew Zhen Lynn (TP076386)
Program Name    : DP.SP.ViewDetails.php
Description     : View Diet Plans in details (Day 1 - Day 7)
First Written on: Sunday, 22-June-2025
-->

<?php
session_start();
if (!isset($_SESSION['usr_user_id'])) {
    echo "<script>alert('Please login first.'); window.location.href = 'login.html';</script>";
    exit;
}

if (!isset($_GET['mpl_id'])) {
    echo "<script>alert('No plan selected.'); window.location.href = 'DP.SP.PlansList.php';</script>";
    exit;
}

include("config.php");
$planId = $_GET['mpl_id'];
$userId = $_SESSION['usr_user_id'];

// Fetch plan from DB
$stmt = $con->prepare("SELECT * FROM meal_plans WHERE mpl_id = ? AND mpl_user_id = ?");
$stmt->bind_param("ii", $planId, $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<script>alert('Plan not found.'); window.location.href = 'DP.SP.PlansList.php';</script>";
    exit;
}

$plan = $result->fetch_assoc();
$planData = json_decode($plan['mpl_plan_data'], true);
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($plan['mpl_title']) ?> - Plan Details</title>
    <style>
        body {
            background: #f9f6f0;
            color: #333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }
        .main-wrapper {
            max-width: 900px;
            margin: 40px auto 0 auto;
            padding: 0 0 40px 0;
            background: #f8f4ec;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(140,120,81,0.08);
        }
        .back-link {
            display: inline-block;
            margin: 24px 0 0 40px;
            color: #8D7151;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.05rem;
        }
        .back-link:hover {
            color: #b38b4f;
        }
        .plan-title {
            color: #8D7151;
            font-family: 'Georgia', 'Times New Roman', serif;
            font-size: 2.1rem;
            font-weight: 700;
            margin: 0 0 10px 0;
            letter-spacing: 0.5px;
            text-align: center;
            padding-top: 32px;
        }
        .plan-meta {
            color: #b38b4f;
            font-size: 1.05rem;
            margin-bottom: 24px;
            text-align: center;
        }
        .plan-actions {
            display: flex;
            gap: 16px;
            justify-content: center;
            margin: 40px 0 0 0;
        }
        .btn-action {
            padding: 10px 28px;
            border-radius: 13px;
            font-size: 0.98rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            background: #8D7151;
            color: #fff;
            box-shadow: 0 2px 8px #e5dbc7, 0 1.5px 0 #fffbe6 inset;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }
        .btn-action.export {
            background: #b38b4f;
            color: #fff;
        }
        .btn-action:active {
            filter: brightness(0.97);
        }
        .day-section {
            margin: 0 40px 28px 40px;
            padding: 0 0 24px 0;
            border-bottom: 1.5px solid #e5dbc7;
        }
        .day-section:last-child {
            border-bottom: none;
        }
        .day-section h2 {
            color: #8D7151;
            font-size: 1.18rem;
            font-family: 'Georgia', 'Times New Roman', serif;
            margin: 0 0 10px 0;
            font-weight: 700;
        }
        .day-section ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 18px 24px;
        }
        .day-section li {
            margin: 0;
            font-size: 1.02rem;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px #e5dbc7;
            padding: 8px 16px;
            display: inline-block;
        }
        @media (max-width: 700px) {
            .main-wrapper { padding: 0 0 24px 0; border-radius: 0; }
            .day-section { margin: 0 8px 18px 8px; }
            .plan-title { font-size: 1.3rem; padding-top: 18px; }
            .back-link { margin-left: 8px; }
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</head>
<body>
    <a href="DP.SP.PlansList.php" class="back-link" style="position: absolute; left: 32px; top: 24px; z-index: 10;"><i class="fas fa-arrow-left"></i> Back to My Plans</a>
    <div class="main-wrapper">
        <h1 class="plan-title"><i class="fas fa-clipboard-list"></i> <?= htmlspecialchars($plan['mpl_title']) ?></h1>
        <div class="plan-meta">Created on: <?= date("d M Y", strtotime($plan['mpl_created_at'])) ?></div>
        <div id="plan-tabs" style="display: flex; justify-content: center; gap: 10px; margin-bottom: 24px; flex-wrap: wrap;">
            <?php foreach ($planData as $index => $day): ?>
                <button class="tab-btn" data-tab="day<?= $index + 1 ?>" style="background: #fff; color: #8D7151; border: 1.5px solid #e5dbc7; border-radius: 8px 8px 0 0; padding: 8px 22px; font-size: 1.01rem; font-weight: 600; cursor: pointer; outline: none; transition: background 0.2s;">Day <?= $index + 1 ?></button>
            <?php endforeach; ?>
        </div>
        <div id="plan-container">
            <?php foreach ($planData as $index => $day): ?>
                <div class="day-section tab-content" id="day<?= $index + 1 ?>" style="display: none; background: #fff; border-radius: 14px; box-shadow: 0 2px 12px #e5dbc7; margin-bottom: 0; padding: 24px 32px;">
                    <h2 style="margin-bottom: 18px;">Day <?= $index + 1 ?></h2>
                    <div style="font-size: 1.08rem; color: #8D7151; line-height: 2.1;">
                        <span class="meal-tooltip" title="Click for more info"><strong>Breakfast:</strong> <?= $day['breakfast']['name'] ?></span><br>
                        <span class="meal-tooltip" title="Click for more info"><strong>Lunch:</strong> <?= $day['lunch']['name'] ?></span><br>
                        <span class="meal-tooltip" title="Click for more info"><strong>Dinner:</strong> <?= $day['dinner']['name'] ?></span><br>
                        <span class="meal-tooltip" title="Click for more info"><strong>Snack:</strong> <?= $day['snack']['name'] ?></span><br>
                        <span><strong>Total Calories:</strong> <?= $day['totalCalories'] ?> kcal</span><br>
                        <span><strong>Total Price:</strong> RM <?= number_format($day['totalPrice'], 2) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="plan-actions" style="justify-content: center; margin: 40px 0 0 0;">
            <form action="DP.SP.DeletePlan.php" method="post" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this plan?');">
                <input type="hidden" name="mpl_id" value="<?= $planId ?>">
                <button type="submit" class="btn-action"><i class="fas fa-trash"></i> Delete Plan</button>
            </form>
            <button id="export-pdf-btn" class="btn-action export"><i class="fas fa-file-pdf"></i> Export as PDF</button>
        </div>
    </div>
    <script>
        // Tab function
        const tabBtns = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');
        function showTab(tabId) {
            tabContents.forEach(tc => tc.style.display = 'none');
            document.getElementById(tabId).style.display = 'block';
            tabBtns.forEach(btn => btn.style.background = '#fff');
            const activeBtn = Array.from(tabBtns).find(btn => btn.dataset.tab === tabId);
            if (activeBtn) activeBtn.style.background = '#f8f4ec';
        }
        if (tabBtns.length) {
            showTab(tabBtns[0].dataset.tab);
            tabBtns.forEach(btn => btn.addEventListener('click', () => showTab(btn.dataset.tab)));
        }
        // Tooltip for meals 
        document.querySelectorAll('.meal-tooltip').forEach(el => {
            el.style.cursor = 'pointer';
            el.addEventListener('click', function() {
                alert(this.textContent.trim());
            });
        });
        // PDF export
        document.getElementById("export-pdf-btn").addEventListener("click", function () {
            const tempContainer = document.createElement('div');
            tempContainer.style.width = '100%';
            tempContainer.style.padding = '20px';
            tempContainer.style.boxSizing = 'border-box';

            const pdfTitle = document.createElement('h1');
            pdfTitle.textContent = document.querySelector('.plan-title').textContent;
            pdfTitle.style.textAlign = 'center';
            pdfTitle.style.marginBottom = '20px';
            tempContainer.appendChild(pdfTitle);

            const pdfMeta = document.createElement('p');
            pdfMeta.textContent = document.querySelector('.plan-meta').textContent;
            pdfMeta.style.textAlign = 'center';
            pdfMeta.style.marginBottom = '30px';
            tempContainer.appendChild(pdfMeta);

            tabContents.forEach(tc => {
                const daySectionContent = document.createElement('div');
                daySectionContent.innerHTML = tc.innerHTML; // Get inner HTML
                daySectionContent.style.marginBottom = '20px';
                daySectionContent.style.border = '1px solid #eee';
                daySectionContent.style.padding = '15px';
                daySectionContent.style.borderRadius = '8px';
                daySectionContent.style.boxShadow = 'none';
                tempContainer.appendChild(daySectionContent);
            });

            document.body.appendChild(tempContainer);

            html2pdf().from(tempContainer).save("MyMealPlan.pdf").then(() => {
                document.body.removeChild(tempContainer);
            });
        });
    </script>
</body>
</html>

