<div class="content__header">
    <h4 class="title">Database queries</h4>
</div>

<div class="margin">
    <div class="scroll on-scroll">
        <table>
            <thead>
            <tr>
                <th>Repository</th>
                <th>Connector</th>
                <th>Query</th>
                <th>Duration</th>
                <th>Execute to</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($this->getParameter('queries') as $query): ?>
                <tr>
                    <td>
                        <span class="mark orange"><?php echo $query->getRepository(); ?></span>
                    </td>
                    <td>
                        <span class="mark blue"><?php echo $query->getConnector(); ?></span>
                    </td>
                    <td>
                        <span class="orange-text"><?php echo $query->getQuery(); ?></span>
                    </td>
                    <td>
                        <span class="green-text"><?php echo $query->getDuration(); ?></span> ms
                    </td>
                    <td>
                        <?php echo $query->getCreatedAt(); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>