import { CustomActionsType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';

import Regenerate from './Regenerate';

const customAction: CustomActionsType = {
  Regenerate: {
    action: Regenerate,
    multiselect: false,
  },
};

export default customAction;
