$start_date = date("Y-m-01");
        $end_date = date("Y-m-t");

        $begin = new \DateTime($start_date);
        $end = new \DateTime($end_date.' + 1 day');
        $interval = \DateInterval::createFromDateString('1 day');
        $period = new \DatePeriod($begin, $interval, $end);

        $datesPeriod = array();
        foreach ($period as $dt) {
            $datesPeriod[$dt->format("Y-m-d")] = 0;
        }

        
        /**
         * Query This Month
         */

        $sql = "SELECT SUM(total_amount) as total_amount,
              DATE(created_at) as date_format
              from payments
              WHERE status = 'success'
              AND (created_at BETWEEN '{$start_date}' AND '{$end_date}')
              GROUP BY date_format
              ORDER BY created_at ASC ;";
        $getEarnings = DB::select(DB::raw($sql));

        $total_amount = array_pluck($getEarnings, 'total_amount');
        $queried_date = array_pluck($getEarnings, 'date_format');

        $dateWiseSales = array_combine($queried_date, $total_amount);

        $chartData = array_merge($datesPeriod, $dateWiseSales);
        foreach ($chartData as $key => $salesCount){
            unset($chartData[$key]);

            $formatDate = date('d M', strtotime($key));
            //$formatDate = date('d', strtotime($key));
            $chartData[$formatDate] = $salesCount ? $salesCount : 0;
        }
        
    
    if (! function_exists('array_prepend')) {

      function array_pluck($array, $value, $key = null)
      {
          return Arr::pluck($array, $value, $key);
      }
}
