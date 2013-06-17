<p>Number of element: {{clInfos.length}}</p>

Search: <input ng-model="searchText">

<table class="table">

<thead>
<tr>
    <th>Centre</th>
    <th>Screening</th>
    <th>Sample ID</th>
</tr>
</thead>


<tbody>
<tr ng-repeat="cl in clInfos | filter: searchText | orderBy:'CENTRE_DESCRIPTION'">
    <td>{{cl.CENTRE_DESCRIPTION}}</td>
    <td>{{cl.SCREENING_NUMBER}}</td>
    <td>{{cl.MATERIAL_ID}}</td>
</tr>
</tbody>

</table>