<?php
/**
 * Created by PhpStorm.
 * User: BHUPENDER SINGH
 * Date: 12/2/2017
 * Time: 9:38 PM
 */
?>
<section class="products-by-category">
    <h2 class="title">
        Products by Category (<span id="countAllProductsByCategory">0</span>) -
        <span id="currentCategory">All Categories</span>
    </h2>
    <div id="categorySelectorWrap" class="dropdown">

        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Category Selector
            <span class="caret"></span></button>
        <ul id="categoryList" class="dropdown-menu dropdown-menu-right">
            <li>All Categories</a></li>
            <li><a href="#">CSS</a></li>
            <li><a href="#">JavaScript</a></li>
        </ul>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Category Name</th>
        </tr>
        </thead>
        <tbody id="tableBodyProductsByCategory">

        </tbody>
    </table>
</section>
