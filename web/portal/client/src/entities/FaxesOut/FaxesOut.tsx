import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';

import FaxesInOut from '../FaxesInOut/FaxesInOut';

const FaxesIn: EntityInterface = {
  ...FaxesInOut,
  localPath: '/faxes_out',
  title: _('Outgoing faxfile', { count: 2 }),
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default FaxesIn;
