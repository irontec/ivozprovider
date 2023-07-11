import useCancelToken from '@irontec/ivoz-ui/hooks/useCancelToken';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { styled } from '@mui/material';
import { useEffect, useState } from 'react';
import { useStoreActions } from 'store';

import { ActiveCalls, DashboardData } from './@types';
import { CardsAmountFactory } from './cards/CardsAmountFactory';
import { TableFactory } from './tables/TableFactory';
import { TitleDescription } from './TitleDescription';

export interface DashboardProps {
  className?: string;
}

const Dashboard = (props: DashboardProps) => {
  const { className } = props;
  const [data, setData] = useState<DashboardData | null>(null);
  const [activeCalls, setActiveCalls] = useState<ActiveCalls | null>(null);
  const apiGet = useStoreActions((store) => store.api.get);
  const [, cancelToken] = useCancelToken();

  useEffect(() => {
    apiGet({
      path: '/my/dashboard',
      params: {},
      cancelToken: cancelToken,
      successCallback: async (response) => {
        setData(response as DashboardData);
      },
    });

    apiGet({
      path: '/my/active_calls',
      params: {},
      cancelToken: cancelToken,
      successCallback: async (response) => {
        setActiveCalls(response as ActiveCalls);
      },
    });
  }, [apiGet, cancelToken]);

  if (!data || !activeCalls) {
    return null;
  }

  const total = activeCalls.total || 0;
  const inbound =
    total === 0 ? '50%' : `${Math.round((activeCalls.inbound / total) * 100)}%`;
  const outbound =
    total === 0
      ? '50%'
      : `${Math.round((activeCalls.outbound / total) * 100)}%`;

  return (
    <section className={className}>
      <div className='card welcome'>
        <div className='card-container'>
          <TitleDescription />
          <img src='assets/img/dashboard-welcome.svg' />
        </div>
      </div>
      <div className='card activity'>
        <div className='title'>{_('Client information')}</div>

        <div className='content'>
          <div className='row'>
            <div className='time'>{_('Name')}</div>
            <div className='value'>{data.client?.name}</div>
          </div>
          <div className='row'>
            <div className='time'>{_('NIF')}</div>
            <div className='value'>{data.client?.nif}</div>
          </div>
          <div className='row'>
            <div className='time'>{_('Postal code')}</div>
            <div className='value'>{data.client?.postalCode}</div>
          </div>
          <div className='row'>
            <div className='time'>{_('Domain Users')}</div>
            <div className='value'>{data.client?.domainUsers}</div>
          </div>
          <div className='row'>
            <div className='time'>{_('Max calls')}</div>
            <div className='value'>{data.client?.maxCalls}</div>
          </div>
        </div>
      </div>
      <CardsAmountFactory activeCalls={activeCalls} data={data} />

      <div className='card licenses'>
        <div className='title'>{_('Active call', { count: 2 })}</div>

        <div className='radial'>
          <div
            className='circle'
            style={
              {
                '--inbound': inbound,
                '--outbound': outbound,
              } as React.CSSProperties
            }
          ></div>
          <div className='data'>
            <div className='total'>{_('Total')}</div>
            <div className='number'>{activeCalls?.total}</div>
          </div>
        </div>

        <div className='legend'>
          <div className='label'>
            <div className='color orange'></div>
            <div className='text'>{_('Outbound')}</div>
          </div>

          <div className='label'>
            <div className='color red'></div>
            <div className='text'>{_('Inbound')}</div>
          </div>
        </div>
      </div>
      <div className='card last'>
        <TableFactory data={data} />
      </div>
    </section>
  );
};

export default styled(Dashboard)(({ theme }) => {
  return {
    [theme.breakpoints.down('md')]: {
      '& ul': {
        paddingInlineStart: '20px',
      },
      '& ul li.submenu li': {
        paddingInlineStart: '40px',
      },
    },
  };
});
