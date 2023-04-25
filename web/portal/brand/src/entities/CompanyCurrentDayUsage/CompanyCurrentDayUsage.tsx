import Company from '../Company/Company';
import SavingsIcon from '@mui/icons-material/Savings';
import _ from '@irontec/ivoz-ui/services/translations/translate';

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
};

export default CompanyCurrentDayUsage;
