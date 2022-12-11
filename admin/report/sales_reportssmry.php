<?php
namespace PHPReportMaker12\project3;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start();

// Autoload
include_once "rautoload.php";
?>
<?php

// Create page object
if (!isset($sales_reports_summary))
	$sales_reports_summary = new sales_reports_summary();
if (isset($Page))
	$OldPage = $Page;
$Page = &$sales_reports_summary;

// Run the page
$Page->run();

// Setup login status
SetClientVar("login", LoginStatus());
if (!$DashboardReport)
	WriteHeader(FALSE);

// Global Page Rendering event (in rusrfn*.php)
Page_Rendering();

// Page Rendering event
$Page->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "rheader.php" ?>
<?php } ?>
<?php if ($Page->Export == "" || $Page->Export == "print") { ?>
<script>
currentPageID = ew.PAGE_ID = "summary"; // Page ID
</script>
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown && !$DashboardReport) { ?>
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown && !$DashboardReport) { ?>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<a id="top"></a>
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-container" class="container-fluid ew-container">
<?php } ?>
<?php if (ReportParam("showfilter") === TRUE) { ?>
<?php $Page->showFilterList(TRUE) ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Page->DrillDownInPanel) {
	$Page->ExportOptions->render("body");
	$Page->SearchOptions->render("body");
	$Page->FilterOptions->render("body");
	$Page->GenerateOptions->render("body");
}
?>
</div>
<?php $Page->showPageHeader(); ?>
<?php $Page->showMessage(); ?>
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
<!-- Center Container - Report -->
<div id="ew-center" class="<?php echo $sales_reports_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary Report begins -->
<div id="report_summary">
<?php

// Set the last group to display if not export all
if ($Page->ExportAll && $Page->Export <> "") {
	$Page->StopGroup = $Page->TotalGroups;
} else {
	$Page->StopGroup = $Page->StartGroup + $Page->DisplayGroups - 1;
}

// Stop group <= total number of groups
if (intval($Page->StopGroup) > intval($Page->TotalGroups))
	$Page->StopGroup = $Page->TotalGroups;
$Page->RecordCount = 0;
$Page->RecordIndex = 0;

// Get first row
if ($Page->TotalGroups > 0) {
	$Page->loadRowValues(TRUE);
	$Page->GroupCount = 1;
}
$Page->GroupIndexes = InitArray(2, -1);
$Page->GroupIndexes[0] = -1;
$Page->GroupIndexes[1] = $Page->StopGroup - $Page->StartGroup + 1;
while ($Page->Recordset && !$Page->Recordset->EOF && $Page->GroupCount <= $Page->DisplayGroups || $Page->ShowHeader) {

	// Show dummy header for custom template
	// Show header

	if ($Page->ShowHeader) {
?>
<?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
<div class="ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } else { ?>
<div class="card ew-card ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_sales_reports" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<table class="<?php echo $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Page->Product_Name->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Product_Name"><div class="sales_reports_Product_Name"><span class="ew-table-header-caption"><?php echo $Page->Product_Name->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Product_Name">
<?php if ($Page->sortUrl($Page->Product_Name) == "") { ?>
		<div class="ew-table-header-btn sales_reports_Product_Name">
			<span class="ew-table-header-caption"><?php echo $Page->Product_Name->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_reports_Product_Name" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Product_Name) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->Product_Name->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->Product_Name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Product_Name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Product_Details->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Product_Details"><div class="sales_reports_Product_Details"><span class="ew-table-header-caption"><?php echo $Page->Product_Details->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Product_Details">
<?php if ($Page->sortUrl($Page->Product_Details) == "") { ?>
		<div class="ew-table-header-btn sales_reports_Product_Details">
			<span class="ew-table-header-caption"><?php echo $Page->Product_Details->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_reports_Product_Details" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Product_Details) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->Product_Details->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->Product_Details->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Product_Details->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->date->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="date"><div class="sales_reports_date"><span class="ew-table-header-caption"><?php echo $Page->date->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="date">
<?php if ($Page->sortUrl($Page->date) == "") { ?>
		<div class="ew-table-header-btn sales_reports_date">
			<span class="ew-table-header-caption"><?php echo $Page->date->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_reports_date" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->date) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->date->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Product_qty->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Product_qty"><div class="sales_reports_Product_qty"><span class="ew-table-header-caption"><?php echo $Page->Product_qty->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Product_qty">
<?php if ($Page->sortUrl($Page->Product_qty) == "") { ?>
		<div class="ew-table-header-btn sales_reports_Product_qty">
			<span class="ew-table-header-caption"><?php echo $Page->Product_qty->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_reports_Product_qty" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Product_qty) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->Product_qty->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->Product_qty->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Product_qty->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Sales_Order_Date->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Sales_Order_Date"><div class="sales_reports_Sales_Order_Date"><span class="ew-table-header-caption"><?php echo $Page->Sales_Order_Date->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Sales_Order_Date">
<?php if ($Page->sortUrl($Page->Sales_Order_Date) == "") { ?>
		<div class="ew-table-header-btn sales_reports_Sales_Order_Date">
			<span class="ew-table-header-caption"><?php echo $Page->Sales_Order_Date->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_reports_Sales_Order_Date" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Sales_Order_Date) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->Sales_Order_Date->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->Sales_Order_Date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Sales_Order_Date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Product_Price->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Product_Price"><div class="sales_reports_Product_Price"><span class="ew-table-header-caption"><?php echo $Page->Product_Price->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Product_Price">
<?php if ($Page->sortUrl($Page->Product_Price) == "") { ?>
		<div class="ew-table-header-btn sales_reports_Product_Price">
			<span class="ew-table-header-caption"><?php echo $Page->Product_Price->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_reports_Product_Price" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Product_Price) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->Product_Price->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->Product_Price->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Product_Price->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->first_name->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="first_name"><div class="sales_reports_first_name"><span class="ew-table-header-caption"><?php echo $Page->first_name->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="first_name">
<?php if ($Page->sortUrl($Page->first_name) == "") { ?>
		<div class="ew-table-header-btn sales_reports_first_name">
			<span class="ew-table-header-caption"><?php echo $Page->first_name->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_reports_first_name" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->first_name) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->first_name->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->first_name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->first_name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->last_name->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="last_name"><div class="sales_reports_last_name"><span class="ew-table-header-caption"><?php echo $Page->last_name->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="last_name">
<?php if ($Page->sortUrl($Page->last_name) == "") { ?>
		<div class="ew-table-header-btn sales_reports_last_name">
			<span class="ew-table-header-caption"><?php echo $Page->last_name->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_reports_last_name" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->last_name) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->last_name->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->last_name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->last_name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Company_Name->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Company_Name"><div class="sales_reports_Company_Name"><span class="ew-table-header-caption"><?php echo $Page->Company_Name->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Company_Name">
<?php if ($Page->sortUrl($Page->Company_Name) == "") { ?>
		<div class="ew-table-header-btn sales_reports_Company_Name">
			<span class="ew-table-header-caption"><?php echo $Page->Company_Name->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_reports_Company_Name" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Company_Name) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->Company_Name->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->Company_Name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Company_Name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->taxable_amount->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="taxable_amount"><div class="sales_reports_taxable_amount"><span class="ew-table-header-caption"><?php echo $Page->taxable_amount->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="taxable_amount">
<?php if ($Page->sortUrl($Page->taxable_amount) == "") { ?>
		<div class="ew-table-header-btn sales_reports_taxable_amount">
			<span class="ew-table-header-caption"><?php echo $Page->taxable_amount->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_reports_taxable_amount" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->taxable_amount) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->taxable_amount->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->taxable_amount->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->taxable_amount->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->tax_amount->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="tax_amount"><div class="sales_reports_tax_amount"><span class="ew-table-header-caption"><?php echo $Page->tax_amount->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="tax_amount">
<?php if ($Page->sortUrl($Page->tax_amount) == "") { ?>
		<div class="ew-table-header-btn sales_reports_tax_amount">
			<span class="ew-table-header-caption"><?php echo $Page->tax_amount->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_reports_tax_amount" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->tax_amount) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->tax_amount->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->tax_amount->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->tax_amount->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Total_Amount->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Total_Amount"><div class="sales_reports_Total_Amount"><span class="ew-table-header-caption"><?php echo $Page->Total_Amount->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Total_Amount">
<?php if ($Page->sortUrl($Page->Total_Amount) == "") { ?>
		<div class="ew-table-header-btn sales_reports_Total_Amount">
			<span class="ew-table-header-caption"><?php echo $Page->Total_Amount->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_reports_Total_Amount" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Total_Amount) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->Total_Amount->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->Total_Amount->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Total_Amount->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Page->TotalGroups == 0) break; // Show header only
		$Page->ShowHeader = FALSE;
	}
	$Page->RecordCount++;
	$Page->RecordIndex++;
?>
<?php

		// Render detail row
		$Page->resetAttributes();
		$Page->RowType = ROWTYPE_DETAIL;
		$Page->renderRow();
?>
	<tr<?php echo $Page->rowAttributes(); ?>>
<?php if ($Page->Product_Name->Visible) { ?>
		<td data-field="Product_Name"<?php echo $Page->Product_Name->cellAttributes() ?>>
<span<?php echo $Page->Product_Name->viewAttributes() ?>><?php echo $Page->Product_Name->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Product_Details->Visible) { ?>
		<td data-field="Product_Details"<?php echo $Page->Product_Details->cellAttributes() ?>>
<span<?php echo $Page->Product_Details->viewAttributes() ?>><?php echo $Page->Product_Details->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->date->Visible) { ?>
		<td data-field="date"<?php echo $Page->date->cellAttributes() ?>>
<span<?php echo $Page->date->viewAttributes() ?>><?php echo $Page->date->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Product_qty->Visible) { ?>
		<td data-field="Product_qty"<?php echo $Page->Product_qty->cellAttributes() ?>>
<span<?php echo $Page->Product_qty->viewAttributes() ?>><?php echo $Page->Product_qty->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Sales_Order_Date->Visible) { ?>
		<td data-field="Sales_Order_Date"<?php echo $Page->Sales_Order_Date->cellAttributes() ?>>
<span<?php echo $Page->Sales_Order_Date->viewAttributes() ?>><?php echo $Page->Sales_Order_Date->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Product_Price->Visible) { ?>
		<td data-field="Product_Price"<?php echo $Page->Product_Price->cellAttributes() ?>>
<span<?php echo $Page->Product_Price->viewAttributes() ?>><?php echo $Page->Product_Price->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->first_name->Visible) { ?>
		<td data-field="first_name"<?php echo $Page->first_name->cellAttributes() ?>>
<span<?php echo $Page->first_name->viewAttributes() ?>><?php echo $Page->first_name->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->last_name->Visible) { ?>
		<td data-field="last_name"<?php echo $Page->last_name->cellAttributes() ?>>
<span<?php echo $Page->last_name->viewAttributes() ?>><?php echo $Page->last_name->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Company_Name->Visible) { ?>
		<td data-field="Company_Name"<?php echo $Page->Company_Name->cellAttributes() ?>>
<span<?php echo $Page->Company_Name->viewAttributes() ?>><?php echo $Page->Company_Name->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->taxable_amount->Visible) { ?>
		<td data-field="taxable_amount"<?php echo $Page->taxable_amount->cellAttributes() ?>>
<span<?php echo $Page->taxable_amount->viewAttributes() ?>><?php echo $Page->taxable_amount->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->tax_amount->Visible) { ?>
		<td data-field="tax_amount"<?php echo $Page->tax_amount->cellAttributes() ?>>
<span<?php echo $Page->tax_amount->viewAttributes() ?>><?php echo $Page->tax_amount->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Total_Amount->Visible) { ?>
		<td data-field="Total_Amount"<?php echo $Page->Total_Amount->cellAttributes() ?>>
<span<?php echo $Page->Total_Amount->viewAttributes() ?>><?php echo $Page->Total_Amount->getViewValue() ?></span></td>
<?php } ?>
	</tr>
<?php

		// Accumulate page summary
		$Page->accumulateSummary();

		// Get next record
		$Page->loadRowValues();
	$Page->GroupCount++;
} // End while
?>
<?php if ($Page->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
	$Page->resetAttributes();
	$Page->RowType = ROWTYPE_TOTAL;
	$Page->RowTotalType = ROWTOTAL_GRAND;
	$Page->RowTotalSubType = ROWTOTAL_FOOTER;
	$Page->RowAttrs["class"] = "ew-rpt-grand-summary";
	$Page->renderRow();
?>
<?php if ($Page->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Page->rowAttributes() ?>><td colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?php echo $ReportLanguage->Phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $ReportLanguage->phrase("RptCnt") ?></span><?php echo $ReportLanguage->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Page->TotalCount,0,-2,-2,-2) ?></span>)</span></td></tr>
<?php } else { ?>
	<tr<?php echo $Page->rowAttributes() ?>><td colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?php echo $ReportLanguage->Phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($Page->TotalCount,0,-2,-2,-2); ?><?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</span></td></tr>
<?php } ?>
	</tfoot>
<?php } elseif (!$Page->ShowHeader && FALSE) { // No header displayed ?>
<?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
<div class="ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } else { ?>
<div class="card ew-card ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_sales_reports" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<table class="<?php echo $Page->ReportTableClass ?>">
<?php } ?>
<?php if ($Page->TotalGroups > 0 || FALSE) { // Show footer ?>
</table>
</div>
<?php if ($Page->Export == "" && !($Page->DrillDown && $Page->TotalGroups > 0)) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php include "sales_reports_pager.php" ?>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
</div>
<!-- Summary Report Ends -->
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
</div>
<!-- /.ew-container -->
<?php } ?>
<?php
$Page->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php

// Close recordsets
if ($Page->GroupRecordset)
	$Page->GroupRecordset->Close();
if ($Page->Recordset)
	$Page->Recordset->Close();
?>
<?php if ($Page->Export == "" && !$Page->DrillDown && !$DashboardReport) { ?>
<script>

// Write your table-specific startup script here
// console.log("page loaded");

</script>
<?php } ?>
<?php if (!$DashboardReport) { ?>
<?php include_once "rfooter.php" ?>
<?php } ?>
<?php
$Page->terminate();
if (isset($OldPage))
	$Page = $OldPage;
?>