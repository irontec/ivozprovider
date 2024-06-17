import defaultEntityBehavior from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  OrderDirection,
} from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
import OutboundIcon from '@mui/icons-material/Outbound';

import {
  FaxesInOutProperties,
  FaxesInOutPropertyList,
} from './FaxesInOutProperties';

const properties: FaxesInOutProperties = {
  calldate: {
    label: _('Call date'),
    format: 'date-time',
  },
  src: {
    label: _('Source'),
  },
  dstCountry: {
    label: _('Country', { count: 1 }),
  },
  dst: {
    label: _('Destination'),
  },
  type: {
    label: _('Type'),
    enum: {
      In: _('In'),
      Out: _('Out'),
    },
  },
  status: {
    label: _('Status'),
    enum: {
      error: _('Error'),
      pending: _('Pending'),
      completed: _('Completed'),
      inprogress: _('In Progress'),
    },
  },
  file: {
    label: _('PDF File'),
    type: 'file',
  },
  fax: {
    label: _('Fax', { count: 1 }),
  },
  pages: {
    label: _('Page'),
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
  toStr: (row: FaxesInOutPropertyList<string>) => `${row.id}`,
  properties,
  columns: ['calldate', 'dst', 'src', 'status', 'file'],
  defaultOrderBy: 'calldate',
  defaultOrderDirection: OrderDirection.desc,
};

export default FaxesInOut;
