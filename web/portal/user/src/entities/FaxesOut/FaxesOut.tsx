import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';

import FaxesInOut from '../FaxesInOut/FaxesInOut';
import Action from './Action';

const FaxesOut: EntityInterface = {
  ...FaxesInOut,
  localPath: '/faxes_out',
  title: _('Outgoing faxfile', { count: 2 }),
  columns: ['calldate', 'dst', 'status', 'file'],
  defaultOrderBy: '',
  customActions: Action,
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default FaxesOut;
