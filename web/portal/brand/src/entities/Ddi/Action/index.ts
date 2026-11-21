import { CustomActionsType } from '@irontec/ivoz-ui/entities/EntityInterface';

import Import from './Import';
import UnlinkDdi from './UnlinkDdi';

const customAction: CustomActionsType = {
  UnlinkDdi: {
    action: UnlinkDdi,
    multiselect: true,
  },
  Import: {
    action: Import,
    global: true,
  },
};

export default customAction;
