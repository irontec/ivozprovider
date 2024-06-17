import { CustomActionsType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';

import Export from './Export';

const customAction: CustomActionsType = {
  Export: {
    action: Export,
    multiselect: true,
  },
};

export default customAction;
