<!DOCTYPE html>
<html>
    <head>
        <title>Transactions</title>
        <style>
            body {
                background-color: lightgrey;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 2px #eee solid;
                border-color: black;
            }

            td {
                background-color: white;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
            #values td {
                background-color: lightgray;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <!-- YOUR CODE -->
                <?php
                    foreach ($dataTransactions as $transaction) {
                        foreach ($transaction as $columns) {
                            $color = getColor($columns["amount"]);
                            echo <<<TEXT
                            <tr>
                                <td>$columns[date]</td>
                                <td>$columns[check]</td>
                                <td>$columns[desc]</td>
                                <td style="color:$color">
                                    $columns[amount]
                                </td>
                            </tr>
                            TEXT;
                        }
                    }
                ?>
            </tbody>
            <tfoot id="values">
                <tr>
                    <th colspan="3">Total Income:</th>
                    <td>
                        <!-- YOUR CODE -->
                        <?php
                            $income = 0;
                            foreach ($rawTransactions as $transaction) {
                               $income += $transaction->getIncome();
                            }
                            $income = formatValue($income);
                            echo $income;
                        ?>
                    </td>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <td>
                        <!-- YOUR CODE -->
                        <?php
                            $expense = 0;
                            foreach ($rawTransactions as $transaction) {
                               $expense += $transaction->getExpense();
                            }
                            $expense = formatValue($expense);
                            echo '-'. $expense;
                        ?>
                    </td>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <td>
                        <!-- YOUR CODE -->
                        <?php
                            $net = 0;
                            foreach ($rawTransactions as $transaction) {
                               $net += $transaction->getNet();
                            }
                            $net = formatValue($net);
                            echo $net;
                        ?>
                    </td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
