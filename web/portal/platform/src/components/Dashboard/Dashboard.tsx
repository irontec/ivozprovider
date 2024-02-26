import {
  CircleChart,
  CircleProps,
} from '@irontec/ivoz-ui/components/Dashboard/CircleChart';
import {
  LightButton,
  SolidButton,
} from '@irontec/ivoz-ui/components/shared/Button/Button.styles';
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
  Tooltip,
} from '@mui/material';
import { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import { useStoreActions } from 'store';

import BrandIcon from './BrandIcon';
import SuiteCaseIcon from './SuitCaseIcon';
import UsersIcon from './UsersIcon';

export interface DashboardProps {
  className?: string;
}

interface DashboardAdmin {
  username: string;
  name: string;
  lastname: string;
  email: string;
}

interface DashboardRecentActivity {
  id: number;
  name: string;
  nif: string;
  sipDomain: string;
  maxCalls: number;
}

interface DashboardData {
  admin: DashboardAdmin;
  recentActivity: DashboardRecentActivity[];
  brandNumber: number;
  clientNumber: number;
  userNumber: number;
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

  const circleProps: CircleProps = {
    data: [
      { key: 'inbound', color: '#e54560', percentage: inbound },
      { key: 'outbound', color: '#f8c14a', percentage: outbound },
    ],
  };

  return (
    <section className={className}>
      <div className='card welcome'>
        <div className='card-container'>
          <div>
            <h3>
              {_('Welcome to <br /> Ivoz Provider global administrator portal')}
            </h3>
            <p>
              {_(
                'Ivoz Provider is an Open Source solution by Irontec. In this portal you can add brands, brand operators, portals URL and much more.'
              )}
            </p>
            <a href='/doc/en/administration_portal/platform/index.html '>
              <LightButton>{_('Get started')}</LightButton>
            </a>
          </div>

          <img src='assets/img/dashboard-welcome.svg' />
        </div>
      </div>
      <div className='card activity'>
        <div className='title'>{_('Operator information')}</div>

        <div className='content'>
          <div className='row'>
            <div className='time'>{_('Iden')}</div>
            <div className='value'>{data.admin.username}</div>
          </div>
          <div className='row'>
            <div className='time'>{_('Name')}</div>
            <div className='value'>{data.admin.name}</div>
          </div>
          <div className='row'>
            <div className='time'>{_('Lastname')}</div>
            <div className='value'>{data.admin.lastname}</div>
          </div>
          <div className='row'>
            <div className='time'>{_('Email')}</div>
            <div className='value'>{data.admin.email}</div>
          </div>
        </div>
      </div>
      <div className='card amount'>
        <div className='img-container'>
          <BrandIcon/>
        </div>

        <div className='number'>{data.brandNumber}</div>

        <div className='name'>{_('Brand', { count: 2 })}</div>

        <Link to='/platform/brands' className='link'>
          {_('Go to brands')}
        </Link>
      </div>

      <div className='card amount'>
        <div className='img-container'>
          <SuiteCaseIcon/>
        </div>

        <div className='number'>{data.clientNumber}</div>

        <div className='name'>{_('Client', { count: 2 })}</div>
      </div>

      <div className='card amount'>
        <div className='img-container'>
          <UsersIcon />
        </div>

        <div className='number'>{data.userNumber}</div>

        <div className='name'>{_('User', { count: 2 })}</div>
      </div>

      <div className='card licenses'>
        <div className='title'>{_('Active call', { count: 2 })}</div>

        <div className='radial'>
          <CircleChart {...circleProps} />
          <div className='data'>
            <div className='total'>{_('Total')}</div>
            <div className='number'>{activeCalls?.total}</div>
          </div>
        </div>

        <div className='legend'>
          <div className='label'>
            <Tooltip
              title={`${activeCalls.outbound} outbound(s)`}
              placement='bottom-start'
              enterTouchDelay={0}
            >
              <div className='color orange'></div>
            </Tooltip>
            <div className='text'>{_('Outbound')}</div>
          </div>

          <div className='label'>
            <Tooltip
              title={`${activeCalls.inbound} inbound(s)`}
              placement='bottom-start'
              enterTouchDelay={0}
            >
              <div className='color red'></div>
            </Tooltip>
            <div className='text'>{_('Inbound')}</div>
          </div>
        </div>
      </div>
      <div className='card last'>
        <div className='header'>
          <div className='title'>{_('Last added brands')}</div>
          <Link to='/platform/brands/create'>
            <SolidButton>+ {_('Add')}</SolidButton>
          </Link>
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
                    {_('TIN')}
                  </TableCell>
                  <TableCell
                    style={{ fontSize: '13px', color: 'var(--color-text)' }}
                  >
                    {_('SIP domain', { count: 1 })}
                  </TableCell>
                  <TableCell
                    style={{ fontSize: '13px', color: 'var(--color-text)' }}
                  >
                    {_('Max Calls')}
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
                    <TableCell>{row.nif}</TableCell>
                    <TableCell>{row.sipDomain}</TableCell>
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
