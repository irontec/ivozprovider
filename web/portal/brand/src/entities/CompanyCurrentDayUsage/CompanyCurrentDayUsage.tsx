import {
  ListDecorator as DefaultListDecorator,
  ListDecoratorType,
} from '@irontec/ivoz-ui';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import DoneIcon from '@mui/icons-material/Done';
import ErrorIcon from '@mui/icons-material/Error';
import SavingsIcon from '@mui/icons-material/Savings';
import WarningIcon from '@mui/icons-material/Warning';

import Company from '../Company/Company';

const ListDecorator: ListDecoratorType = (props) => {
  const { field, row } = props;
  const { currencySymbol } = row;

  if (field === 'currentDayUsage') {
    const amount = parseFloat(row.currentDayUsage).toFixed(2);

    return (
      <>
        {amount} {currencySymbol}
      </>
    );
  }

  if (field === 'maxDailyUsage') {
    const maxDailyUsage =
      row.maxDailyUsage >= 1000000 ? '∞' : row.maxDailyUsage;

    return (
      <>
        {maxDailyUsage} {currencySymbol}
      </>
    );
  }

  if (field === 'accountStatus') {
    const accountStatus = row.accountStatus;

    if (accountStatus === 'Active') {
      return <DoneIcon titleAccess={accountStatus} />;
    }

    if (accountStatus === 'Inactive') {
      return <WarningIcon titleAccess={accountStatus} />;
    }

    return <ErrorIcon titleAccess={accountStatus} />;
  }

  return <DefaultListDecorator {...props} />;
};

const CompanyCurrentDayUsage = {
  ...Company,
  acl: {
    read: true,
    write: false,
    delete: false,
    update: false,
    detail: false,
  },
  icon: SavingsIcon,
  title: _('Current Day Usage', { count: 2 }),
  localPath: '/current_day_usage',
  columns: [
    'typeIcon',
    'name',
    'currentDayUsage',
    'maxDailyUsage',
    'accountStatus',
  ],
  ListDecorator,
};

export default CompanyCurrentDayUsage;
