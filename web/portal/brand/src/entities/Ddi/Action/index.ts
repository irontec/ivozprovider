import { CustomActionsType } from '@irontec/ivoz-ui/entities/EntityInterface';

import UnlinkDdi from './UnlinkDdi';

const customAction: CustomActionsType = {
  UnlinkDdi: {
    action: UnlinkDdi,
    multiselect: true,
  },
};

export default customAction;
