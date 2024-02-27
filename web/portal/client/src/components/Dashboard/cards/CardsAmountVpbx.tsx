import _ from '@irontec/ivoz-ui/services/translations/translate';
import { Link } from 'react-router-dom';

import DialpadIcon from '../DialpadIcon';
import HashIcon from '../HashIcon';
import UsersIcon from '../UsersIcon';


export const CardsAmountVpbx = (props: DashboardData): JSX.Element => {
  const { userNum, extensionNum, ddiNum } = props;

  return (
    <>
      <div className='card amount'>
        <div className='img-container'>
          <UsersIcon />
        </div>

        <div className='number'>{userNum}</div>

        <div className='name'>{_('User', { count: 2 })}</div>

        <Link to='/client/users' className='link'>
          {_('Go to Users')}
        </Link>
      </div>

      <div className='card amount'>
        <div className='img-container'>
          <HashIcon />
        </div>

        <div className='number'>{extensionNum}</div>

        <div className='name'>{_('Extension', { count: 2 })}</div>

        <Link to='/client/extensions' className='link'>
          {_('Go to Extensions')}
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
    </>
  );
};
