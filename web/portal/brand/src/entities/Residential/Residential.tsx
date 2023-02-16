import Company from '../Company/Company';
import { foreignKeyGetter } from './ForeignKeyGetter';
import HouseIcon from '@mui/icons-material/House';
import _ from '@irontec/ivoz-ui/services/translations/translate';

const Residential = {
  ...Company,
  properties: {
    ...Company.properties,
    outgoingDdi: {
      label: _('Fallback Outgoing DDI'),
      null: _('Unassigned'),
      default: '__null__',
    },
  },
  icon: HouseIcon,
  title: _('Residential', { count: 2 }),
  localPath: '/residential',
  columns: [
    'name',
    'invocing.nif',
    'billingMethod',
    'outgoingDdi',
    'featureIds',
  ],
  foreignKeyGetter,
};

export default Residential;
