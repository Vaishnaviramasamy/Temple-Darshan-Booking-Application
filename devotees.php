<?php
include 'db.php';

// Pagination settings
$limit = 10; // rows per page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Search filter (if any)
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Prepare query with search and pagination
if ($search !== '') {
    $search_escaped = mysqli_real_escape_string($conn, $search);
    $countQuery = "SELECT COUNT(*) as total FROM users WHERE name LIKE '%$search_escaped%' OR email LIKE '%$search_escaped%'";
    $dataQuery = "SELECT * FROM users WHERE name LIKE '%$search_escaped%' OR email LIKE '%$search_escaped%' ORDER BY name ASC LIMIT $limit OFFSET $offset";
} else {
    $countQuery = "SELECT COUNT(*) as total FROM users";
    $dataQuery = "SELECT * FROM users ORDER BY name ASC LIMIT $limit OFFSET $offset";
}

// Get total count for pagination
$countResult = mysqli_query($conn, $countQuery);
$totalRows = mysqli_fetch_assoc($countResult)['total'];
$totalPages = ceil($totalRows / $limit);

$result = mysqli_query($conn, $dataQuery);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Registered Devotees</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f3f6fd;
      padding: 30px;
    }
    h2 {
      text-align: center;
      color: #1a237e;
    }
    #searchBox {
      display: block;
      margin: 20px auto 10px;
      width: 300px;
      padding: 10px 15px;
      font-size: 16px;
      border: 2px solid #1a237e;
      border-radius: 6px;
      outline: none;
      transition: border-color 0.3s;
    }
    #searchBox:focus {
      border-color: #3949ab;
    }
    table {
      border-collapse: collapse;
      width: 90%;
      margin: 0 auto 20px;
      background: white;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      border-radius: 8px;
      overflow: hidden;
    }
    th, td {
      padding: 12px 15px;
      border-bottom: 1px solid #ddd;
      text-align: left;
      cursor: default;
    }
    th {
      background-color: #1a237e;
      color: white;
      user-select: none;
      cursor: pointer;
    }
    tr:hover {
      background-color: #e8eaf6;
    }
    /* Pagination Buttons */
    .pagination {
      text-align: center;
      margin-top: 10px;
    }
    .pagination button {
      background-color: #3949ab;
      color: white;
      border: none;
      padding: 8px 16px;
      margin: 0 5px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
      transition: background-color 0.3s;
    }
    .pagination button:disabled {
      background-color: #9fa8da;
      cursor: default;
    }
    .pagination button:hover:not(:disabled) {
      background-color: #1a237e;
    }
  </style>
</head>
<body>

  <h2>List of Registered Devotees</h2>

  <form method="get" action="" style="text-align:center;">
    <input
      type="text"
      id="searchBox"
      name="search"
      placeholder="Search by Name or Email..."
      value="<?= htmlspecialchars($search) ?>"
      autocomplete="off"
    />
  </form>

  <table id="devoteesTable">
    <thead>
      <tr>
        <th data-sort="name">Name &#x25B2;&#x25BC;</th>
        <th data-sort="email">Email &#x25B2;&#x25BC;</th>
        <th data-sort="phone">Phone &#x25B2;&#x25BC;</th>
      </tr>
    </thead>
    <tbody>
      <?php if(mysqli_num_rows($result) > 0): ?>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
          <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['phone']) ?></td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="3" style="text-align:center;">No records found.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>

  <div class="pagination">
    <?php if ($page > 1): ?>
      <a href="?search=<?= urlencode($search) ?>&page=<?= $page - 1 ?>">
        <button>Prev</button>
      </a>
    <?php else: ?>
      <button disabled>Prev</button>
    <?php endif; ?>

    Page <?= $page ?> of <?= $totalPages ?>

    <?php if ($page < $totalPages): ?>
      <a href="?search=<?= urlencode($search) ?>&page=<?= $page + 1 ?>">
        <button>Next</button>
      </a>
    <?php else: ?>
      <button disabled>Next</button>
    <?php endif; ?>
  </div>

  <script>
    // Client-side sorting for the current page only
    const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

    const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
      v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2)
        ? v1 - v2
        : v1.toString().localeCompare(v2)
    )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

    document.querySelectorAll('th[data-sort]').forEach(th => th.addEventListener('click', (() => {
      const table = th.closest('table');
      Array.from(table.querySelectorAll('tbody > tr'))
        .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
        .forEach(tr => table.querySelector('tbody').appendChild(tr));
    })));
  </script>

</body>
</html>
