import {
  CircleChart,
  CircleProps,
} from '@irontec/ivoz-ui/components/Dashboard/CircleChart';
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
  Tooltip,
} from '@mui/material';
import { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import { useStoreActions } from 'store';

import ChatBubbleIcon from './ChatBubbleIcon';
import PhoneForwardedIcon from './PhoneForwardedIcon';

export interface DashboardProps {
  className?: string;
}

interface DashboardData {
  userName: string;
  userLastName: string;
  email: string;
  outgoingDdi: string;
  extension: string;
  terminal: string;
}

interface LastMonthCalls {
  inbound: number;
  outbound: number;
  total: number;
}

interface LastCall {
  startTime: string;
  caller: string;
  callee: string;
  duration: string;
}

const Dashboard = (props: DashboardProps) => {
  const { className } = props;

  const [data, setData] = useState<DashboardData | null>(null);
  const [lastMonthCalls, setLastMonthCalls] = useState<LastMonthCalls | null>(
    null
  );
  const [lastCalls, setLastCalls] = useState<LastCall[]>([]);
  const [callForward, setCallForward] = useState<number | null>(null);

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
      path: '/my/last_month_calls',
      params: {},
      cancelToken: cancelToken,
      successCallback: async (response) => {
        setLastMonthCalls(response as LastMonthCalls);
      },
    });

    apiGet({
      path: '/my/call_forward_settings',
      params: {},
      cancelToken: cancelToken,
      successCallback: async (response) => {
        setCallForward((response as Record<string, unknown>[]).length);
      },
    });

    apiGet({
      path: '/my/call_history?_itemsPerPage=4&_page=1&_pagination=true',
      params: {},
      cancelToken: cancelToken,
      successCallback: async (response) => {
        setLastCalls(response as LastCall[]);
      },
    });
  }, [apiGet, cancelToken]);

  if (!data || !lastMonthCalls) {
    return null;
  }

  const total = lastMonthCalls.total || 0;
  const inbound =
    total === 0
      ? '50%'
      : `${Math.round((lastMonthCalls.inbound / total) * 100)}%`;
  const outbound =
    total === 0
      ? '50%'
      : `${Math.round((lastMonthCalls.outbound / total) * 100)}%`;

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
            <h3>{_('Welcome to <br />Ivoz Provider vPBX user portal')}</h3>
            <p>
              {_(
                'Ivoz Provider is an Open Source solution by Irontec. In this portal you can see and modify your configuration, list your calls and much more.'
              )}
            </p>
            <a href='/doc/en/user_portal/index.html'>
              <LightButton>{_('Get started')}</LightButton>
            </a>
          </div>

          <img src='assets/img/dashboard-welcome.svg' />
        </div>
      </div>
      <div className='card activity'>
        <div className='title'>{_('User information')}</div>

        <div className='content'>
          <div className='row'>
            <div className='time'>{_('Name')}</div>
            <div className='value'>
              {data.userName} {data.userLastName}
            </div>
          </div>
          <div className='row'>
            <div className='time'>{_('Extension')}</div>
            <div className='value'>{data.extension}</div>
          </div>
          <div className='row'>
            <div className='time'>{_('Terminal')}</div>
            <div className='value'>{data.terminal}</div>
          </div>
          <div className='row'>
            <div className='time'>{_('Email')}</div>
            <div className='value'>{data.email}</div>
          </div>
          <div className='row'>
            <div className='time'>{_('Outbound DDI')}</div>
            <div className='value'>{data.outgoingDdi}</div>
          </div>
        </div>
      </div>
      <div className='card amount'>
        <div className='img-container'>
          <PhoneForwardedIcon />
        </div>

        <div className='number'>{callForward}</div>

        <div className='name'>{_('Call forward setting', { count: 2 })}</div>

        <Link to='/user/my/call_forward_settings' className='link'>
          {_('Go to Call Forward Setting')}
        </Link>
      </div>

      <div className='card amount'>
        <div className='img-container'>
          <ChatBubbleIcon />
        </div>

        <div className='number'>{lastMonthCalls.inbound}</div>

        <div className='name'>{_('Inbound Call', { count: 2 })}</div>

        <Link to='/user/my/call_history' className='link'>
          {_('Go to Calls')}
        </Link>
      </div>

      <div className='card amount'>
        <div className='img-container'>
          <ChatBubbleIcon />
        </div>

        <div className='number'>{lastMonthCalls.outbound}</div>

        <div className='name'>{_('Outbound Call', { count: 2 })}</div>

        <Link to='/user/my/call_history' className='link'>
          {_('Go to Calls')}
        </Link>
      </div>

      <div className='card licenses'>
        <div className='title'>{_('Active call', { count: 2 })}</div>

        <div className='radial'>
          <CircleChart {...circleProps} />
          <div className='data'>
            <div className='total'>{_('Total')}</div>
            <div className='number'>{lastMonthCalls?.total}</div>
          </div>
        </div>

        <div className='legend'>
          <div className='label'>
            <Tooltip
              title={`${lastMonthCalls.outbound} outbound(s)`}
              placement='bottom-start'
              enterTouchDelay={0}
            >
              <div className='color orange'></div>
            </Tooltip>
            <div className='text'>{_('Outbound')}</div>
          </div>

          <div className='label'>
            <Tooltip
              title={`${lastMonthCalls.inbound} inbound(s)`}
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
          <div className='title'>{_('Last Calls')}</div>
        </div>

        <div className='table'>
          <TableContainer component={Paper} sx={{ boxShadow: 'none' }}>
            <Table sx={{ minWidth: 650 }} aria-label='simple table'>
              <TableHead>
                <TableRow style={{ fontSize: '13px' }}>
                  <TableCell
                    style={{ fontSize: '13px', color: 'var(--color-text)' }}
                  >
                    {_('Date')}
                  </TableCell>
                  <TableCell
                    style={{ fontSize: '13px', color: 'var(--color-text)' }}
                  >
                    {_('Caller')}
                  </TableCell>
                  <TableCell
                    style={{ fontSize: '13px', color: 'var(--color-text)' }}
                  >
                    {_('Callee')}
                  </TableCell>
                  <TableCell
                    style={{ fontSize: '13px', color: 'var(--color-text)' }}
                  >
                    {_('Duration')}
                  </TableCell>
                </TableRow>
              </TableHead>
              <TableBody>
                {lastCalls.map((row, key) => (
                  <TableRow
                    key={key}
                    sx={{ '&:last-child td, &:last-child th': { border: 0 } }}
                  >
                    <TableCell component='th' scope='row'>
                      {row.startTime}
                    </TableCell>
                    <TableCell>{row.caller}</TableCell>
                    <TableCell>{row.callee}</TableCell>
                    <TableCell>{row.duration}</TableCell>
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
