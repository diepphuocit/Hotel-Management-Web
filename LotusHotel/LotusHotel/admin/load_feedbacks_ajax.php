<?php 
include('../db.php');

$sql = "
    SELECT c.id, c.fullname, c.phone, c.email, c.message, c.cdate,
           r.reply AS admin_reply, r.rdate
    FROM contact c
    LEFT JOIN reply r ON c.id = r.contact_id
    ORDER BY c.id DESC
";
$stmt = $con->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $row):
?>
<tr>
    <td><?= htmlspecialchars($row['fullname']) ?></td>
    <td><?= htmlspecialchars($row['phone']) ?></td>
    <td><?= htmlspecialchars($row['email']) ?></td>
    <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
    <td><?= htmlspecialchars($row['cdate']) ?></td>
    <td>
        <?php if ($row['admin_reply']): ?>
            <div style="max-height: 100px; overflow-y: auto;">
                <?= nl2br(htmlspecialchars($row['admin_reply'])) ?><br>
                <small><i>Gửi ngày <?= htmlspecialchars($row['rdate']) ?></i></small>
            </div>
        <?php else: ?>
            <form class="reply-form">
                <input type="hidden" name="contact_id" value="<?= $row['id'] ?>">
                <textarea name="admin_reply" class="form-control" rows="2" required></textarea>
                <button type="submit" name="send_reply" class="btn btn-primary btn-sm" style="margin-top: 5px;">
                    <i class="fa fa-reply"></i> Gửi
                </button>
            </form>
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>
