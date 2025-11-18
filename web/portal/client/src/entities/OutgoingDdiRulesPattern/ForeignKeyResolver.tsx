import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

import { OutgoingDdiRulesPatternPropertiesList } from './OutgoingDdiRulesPatternProperties';

const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
}): Promise<OutgoingDdiRulesPatternPropertiesList> {
  const entities = store.getState().entities.entities;
  const { Ddi } = entities;
  const iterable = Array.isArray(data) ? data : [data];

  for (const row of iterable) {
    if (row.forcedDdi && typeof row.forcedDdi !== 'string') {
      row.forcedDdiId = row.forcedDdi.id;
      row.forcedDdi = Ddi.toStr(row.forcedDdi);
    }
  }

  return data;
};

export default foreignKeyResolver;
