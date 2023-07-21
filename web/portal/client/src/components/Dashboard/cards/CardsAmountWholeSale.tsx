import _ from '@irontec/ivoz-ui/services/translations/translate';
import { Link } from 'react-router-dom';

import { ActiveCalls } from '../@types';
import IconClientsDashboard from '../IconClients';
import IconPlatformsDashboard from '../IconPlatforms';
import IconUsersDashboard from '../IconUsers';

export const CardsAmountWholesale = (props: {
  activeCalls?: ActiveCalls;
}): JSX.Element => {
  return (
    <>
      <div className='card amount'>
        <div className='img-container'>
          <IconPlatformsDashboard />
        </div>

        <div className='number'>{props.activeCalls?.total}</div>

        <div className='name'>{_('Active call', { count: 2 })}</div>
        <Link to='/client/active_calls' className='link'>
          {_('Go to Active Calls')}
        </Link>
      </div>

      <div className='card amount'>
        <div className='img-container'>
          <IconClientsDashboard />
        </div>

        <div className='number'>{props.activeCalls?.inbound}</div>

        <div className='name'>{_('Inbound Call', { count: 2 })}</div>

        <Link to='/client/active_calls' className='link'>
          {_('Go to Active Calls')}
        </Link>
      </div>

      <div className='card amount'>
        <div className='img-container'>
          <IconUsersDashboard />
        </div>

        <div className='number'>{props.activeCalls?.outbound}</div>

        <div className='name'>{_('Outbound Call', { count: 2 })}</div>

        <Link to='/client/active_calls' className='link'>
          {_('Go to Active Calls')}
        </Link>
      </div>
    </>
  );
};
