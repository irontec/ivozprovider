import OutboundIcon from '@mui/icons-material/Outbound';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { FaxesInOutProperties } from './FaxesInOutProperties';

const properties: FaxesInOutProperties = {
  'calldate': {
    label: _('Calldate'),
    format: 'date-time',
  },
  'src': {
    label: _('Source'),
  },
  'dst': {
    label: _('Destination'),
  },
  'type': {
    label: _('Type'),
    enum: {
      'In': _('In'),
      'Out': _('Out'),
    },
  },
  'status': {
    label: _('Status'),
    enum: {
      'error': _('Error'),
      'pending': _('Pending'),
      'completed': _('Completed'),
      'inprogress': _('In Progress'),
    },
  },
  'file': {
    label: _('PDF File'),
    type: 'file',
  },
};

const FaxesInOut: EntityInterface = {
  ...defaultEntityBehavior,
  icon: OutboundIcon,
  iden: 'FaxesInOut',
  title: _('Faxfile', { count: 2 }),
  path: '/faxes_in_outs',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'FaxesInOut',
  },
  toStr: (row: any) => row.name,
  properties,
};

export default FaxesInOut;