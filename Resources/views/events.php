<div class="content__header">
    <h4 class="title">List of Events</h4>
</div>

<div class="margin">
    <div class="scroll on-scroll">
        <table>
            <thead>
            <tr>
                <th>Event</th>
                <th>Listeners</th>
                <th>Demanded</th>
                <th>Completed</th>
                <th>Lead time</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($this->getParameter('events') as $event): ?>
                <tr>
                    <td>
                        <span class="mark orange"><?php echo $event->getEvent(); ?></span>
                    </td>
                    <td>
                        <?php foreach ($event->getListeners() as $listener): ?>
                            <span class="orange-text"><?php echo $listener; ?></span><br>
                        <?php endforeach; ?>
                    </td>
                    <td>
                        <span class="mark blue"><?php echo $event->getDemandedClass(); ?></span>
                        <span class="mark red"><?php echo $event->getDemandedMethod(); ?></span>
                    </td>
                    <td><?php echo $event->getCompleted(); ?></td>
                    <td>
                        <span class="blue-text"><?php echo round($event->getLeadTime()); ?> ms</span> <br>
                        <span class="yellow-text">(<?php echo number_format($event->getLeadTime() / 1000, 3); ?> s)</span>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>