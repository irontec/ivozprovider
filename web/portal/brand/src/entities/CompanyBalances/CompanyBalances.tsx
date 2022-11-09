import Company from '../Company/Company';
import CurrencyYenIcon from '@mui/icons-material/CurrencyYen';
import _ from '@irontec/ivoz-ui/services/translations/translate';

const CompanyBalances = {
  ...Company,
  icon: CurrencyYenIcon,
  title: _('Prepaid Balance', { count: 2 }),
  localPath: '/prepaid_balance',
  columns: ['typeIcon', 'name', 'billingMethod', 'balance'],
};

export default CompanyBalances;
