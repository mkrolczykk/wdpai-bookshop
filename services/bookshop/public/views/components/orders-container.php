<div class="orders-container">
    <section class="orders-section">
        <table class="orders-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Created at</th>
                    <th>Total</th>
                    <th>Currency</th>
                    <th>Status</th>
                    <th>Assigned to</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr id="order-row-<?php echo $order->getOrderId(); ?>">
                        <td><?php echo $order->getOrderId(); ?></td>
                        <td><?php echo $order->getOrderTime(); ?></td>
                        <td><?php echo $order->getTotal(); ?></td>
                        <td><?php echo $order->getCurrency(); ?></td>
                        <td><?php echo $order->getOrderStatus(); ?></td>
                        <td class="order-executor"><?php echo $order->getOrderExec() !== null ? ($order->getOrderExecId() == $_SESSION["id"] ? "Me" : $order->getOrderExec()) : "-"; ?></td>
                        <td>
                            <div class="order-dropdown">
                                <button class="fa fa-caret-down fa-xl order-dropdown-btn" onclick="toggleOrderDropdown(this)"></button>
                                <div class="order-dropdown-content">
                                    <a class="finish-action" onclick="markAsFinished(<?php echo $order->getOrderId(); ?>)">Set as finished</a>
                                    <?php if ((null === $order->getOrderExec()) || ($_SESSION["roleId"] == Role::ROLE_ADMIN)): ?>
                                        <div class="assign-dropdown">
                                            <a class="assign-to" onclick="toggleOrderDropdown(this)"><span class="fa fa-caret-left fa-lg"></span>Assign to</a>
                                            <div class="assign-dropdown-content">
                                                <?php foreach ($employees as $employee): ?>
                                                    <?php if ($_SESSION["id"] == $employee->getEmployeeId()): ?>
                                                        <a class="assign-option" onclick="assignToEmployee(<?php echo $order->getOrderId(); ?>, <?php echo $employee->getEmployeeId(); ?>, 'Me');">Me</a>
                                                    <?php else: ?>
                                                        <a class="assign-option" onclick="assignToEmployee(<?php echo $order->getOrderId(); ?>, <?php echo $employee->getEmployeeId(); ?>, '<?php echo $employee->getEmployeeName() . ' ' . $employee->getEmployeeSurname(); ?>');"><?php echo $employee->getEmployeeName() . ' ' . $employee->getEmployeeSurname(); ?></a>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
    <script type="text/javascript" src="public/js/order/toggle-order-dropdown.js"></script>
    <script type="text/javascript" src="public/js/order/assign-employee-to-order.js"></script>
    <script type="text/javascript" src="public/js/order/mark-as-finished.js"></script>
</div>