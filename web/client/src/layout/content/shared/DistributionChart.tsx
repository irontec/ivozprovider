import React from 'react';
import {
  BarChart, Bar, XAxis, YAxis, Tooltip, Legend, ResponsiveContainer
} from 'recharts';

function DistributionChart(props:any) {

  const data = props.stats.backupDetails.distribution.map((row:any) => {
    const rowCopy = {...row};
    rowCopy.start = rowCopy.start * -1;

    return rowCopy;
  });

  const TooltipContent = (props:any) => {

    if (!props.payload || props.payload.length < 2) {
      return null;
    }

    const style = {
      padding: 6,
      backgroundColor: '#424242',
      border: '1px solid rgba(255, 255, 255, 0.2)',
    };

    return (
      <div className="area-chart-tooltip" style={style}>
        <p>{Math.abs(props.payload[0].value)} started</p>
        <p>{props.payload[1].value} ended</p>
        <p>{props.payload[1].payload.acc} accumulated</p>
      </div>
    );
  };

  return (
    <ResponsiveContainer width={'100%'} min-sidth={300} height={data.length * 50 + 100} min-height={100}>
      <BarChart
        data={data}
        margin={{right: 55}}
        layout="vertical"
        stackOffset="sign"
      >
        <XAxis type="number" orientation="top" hide={true} />
        <YAxis dataKey="hour" type="category" />
        <Legend verticalAlign="bottom" iconType="circle" align="right" />
        <Tooltip cursor={{ strokeWidth: 0, fill: "#494949" }} content={TooltipContent} />
        <Bar dataKey="start" stackId="x" fill="rgba(255, 38, 38, .3)" />
        <Bar dataKey="end" stackId="x" fill="rgba(38, 150, 38, .3)" />
      </BarChart>
    </ResponsiveContainer>
  );
}

export default DistributionChart;