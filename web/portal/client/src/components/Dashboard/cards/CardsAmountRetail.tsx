import _ from '@irontec/ivoz-ui/services/translations/translate';
import { Link } from 'react-router-dom';

import { DashboardData } from '../@types';
import ActiveCallIcon from '../ActiveCallIcon';
import DialpadIcon from '../DialpadIcon';
import RetailIcon from '../RetailIcon';

export const CardsAmountRetail = (props: DashboardData): JSX.Element => {
  const { ddiNum, retailsAccountNum, activeCallsNum } = props;

  return (
    <>
      <div className='card amount'>
        <div className='img-container'>
          <RetailIcon />
        </div>

        <div className='number'>{retailsAccountNum}</div>

        <div className='name'>{_('Retail Account', { count: 2 })}</div>

        <Link to='/client/retail_accounts' className='link'>
          {_('Go to Retail Accounts')}
        </Link>
      </div>

      <div className='card amount'>
        <div className='img-container'>
          <DialpadIcon />
        </div>

        <div className='number'>{ddiNum}</div>

        <div className='name'>{_('DDI', { count: 2 })}</div>

        <Link to='/client/ddis' className='link'>
          {_('Go to DDIs')}
        </Link>
      </div>

      <div className='card amount'>
        <div className='img-container'>
          <ActiveCallIcon />
        </div>

        <div className='number'>{activeCallsNum}</div>

        <div className='name'>{_('Active call', { count: 2 })}</div>

        <Link to='/client/active_calls' className='link'>
          {_('Go to Active Calls')}
        </Link>
      </div>
    </>
  );
};
