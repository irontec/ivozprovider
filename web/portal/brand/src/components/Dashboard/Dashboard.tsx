import { LightButton } from '@irontec/ivoz-ui/components/shared/Button/Button.styles';
import useCancelToken from '@irontec/ivoz-ui/hooks/useCancelToken';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import {
  Paper,
  styled,
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableHead,
  TableRow,
} from '@mui/material';
import { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import { useStoreActions } from 'store';

import IconClientsDashboard from './IconClients';
import IconPlatformsDashboard from './IconPlatforms';
import IconUsersDashboard from './IconUsers';

export interface DashboardProps {
  className?: string;
}

interface DashboardBrand {
  id: number;
  maxCalls: string;
  name: string;
  nif: string;
  postalCode: string;
  sipDomain: string;
}

interface DashboardRecentActivity {
  domainUsers: string;
  maxCalls: number;
  name: string;
  type: string;
}

interface DashboardData {
  brand: DashboardBrand;
  recentActivity: DashboardRecentActivity[];
  carrierNum: number;
  clientNum: number;
  ddiNum: number;
}

interface ActiveCalls {
  inbound: number;
  outbound: number;
  total: number;
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
          <div>
            <h3>
              {_('Welcome to <br />Ivoz Provider brand administrator portal')}
            </h3>
            <p>
              {_(
                'Ivoz Provider is an Open Source solution by Irontec. In this portal you can add clients, carriers and much more.'
              )}
            </p>
            <a href='/doc/en/administration_portal/brand/index.html'>
              <LightButton>{_('Get started')}</LightButton>
            </a>
          </div>

          <img src='assets/img/dashboard-welcome.svg' />
        </div>
      </div>
      <div className='card activity'>
        <div className='title'>{_('Brand information')}</div>

        <div className='content'>
          <div className='row'>
            <div className='time'>{_('Name')}</div>
            <div className='value'>{data.brand.name}</div>
          </div>
          <div className='row'>
            <div className='time'>{_('TIN')}</div>
            <div className='value'>{data.brand.nif}</div>
          </div>
          <div className='row'>
            <div className='time'>{_('Postal code')}</div>
            <div className='value'>{data.brand.postalCode}</div>
          </div>
          <div className='row'>
            <div className='time'>{_('SIP domain')}</div>
            <div className='value'>{data.brand.sipDomain}</div>
          </div>
          <div className='row'>
            <div className='time'>{_('Max calls')}</div>
            <div className='value'>{data.brand.maxCalls}</div>
          </div>
        </div>
      </div>
      <div className='card amount'>
        <div className='img-container'>
          <IconPlatformsDashboard />
        </div>

        <div className='number'>{data.clientNum}</div>

        <div className='name'>{_('Client', { count: 2 })}</div>
      </div>

      <div className='card amount'>
        <div className='img-container'>
          <IconClientsDashboard />
        </div>

        <div className='number'>{data.ddiNum}</div>

        <div className='name'>{_('DDI', { count: 2 })}</div>

        <Link to='/brand/ddis' className='link'>
          {_('Go to DDIs')}
        </Link>
      </div>

      <div className='card amount'>
        <div className='img-container'>
          <IconUsersDashboard />
        </div>

        <div className='number'>{data.carrierNum}</div>

        <div className='name'>{_('Carrier', { count: 2 })}</div>

        <Link to='/brand/carriers' className='link'>
          {_('Go to Carriers')}
        </Link>
      </div>

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
        <div className='header'>
          <div className='title'>{_('Last added clients')}</div>
        </div>

        <div className='table'>
          <TableContainer component={Paper} sx={{ boxShadow: 'none' }}>
            <Table sx={{ minWidth: 650 }} aria-label='simple table'>
              <TableHead>
                <TableRow style={{ fontSize: '13px' }}>
                  <TableCell
                    style={{ fontSize: '13px', color: 'var(--color-text)' }}
                  >
                    {_('Name')}
                  </TableCell>
                  <TableCell
                    style={{ fontSize: '13px', color: 'var(--color-text)' }}
                  >
                    {_('Type')}
                  </TableCell>
                  <TableCell
                    style={{ fontSize: '13px', color: 'var(--color-text)' }}
                  >
                    {_('SIP domain')}
                  </TableCell>
                  <TableCell
                    style={{ fontSize: '13px', color: 'var(--color-text)' }}
                  >
                    {_('Max calls')}
                  </TableCell>
                </TableRow>
              </TableHead>
              <TableBody>
                {data.recentActivity.map((row, key) => (
                  <TableRow
                    key={key}
                    sx={{ '&:last-child td, &:last-child th': { border: 0 } }}
                  >
                    <TableCell component='th' scope='row'>
                      {row.name}
                    </TableCell>
                    <TableCell>{row.type}</TableCell>
                    <TableCell>{row.domainUsers}</TableCell>
                    <TableCell>{row.maxCalls}</TableCell>
                  </TableRow>
                ))}
              </TableBody>
            </Table>
          </TableContainer>
        </div>
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