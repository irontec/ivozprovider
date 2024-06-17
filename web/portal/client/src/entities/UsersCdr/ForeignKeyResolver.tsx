import { autoForeignKeyResolver } from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import genericForeignKeyResolver from '@irontec-voip/ivoz-ui/services/api/genericForeigKeyResolver';
import store from 'store';

import { UsersCdrRows } from './UsersCdrProperties';

export const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  allowLinks = true,
  cancelToken,
  entityService,
}): Promise<UsersCdrRows> {
  const entities = store.getState().entities.entities;
  const { User, Extension } = entities;

  const promises = autoForeignKeyResolver({
    data,
    cancelToken,
    entityService,
    skip: ['user'],
  });

  promises.push(
    // User & User.extension
    genericForeignKeyResolver({
      data,
      fkFld: 'user',
      entity: {
        ...User,
        toStr: (row) => {
          let response = `${row.name} ${row.lastname}`;
          if (row.extensionId) {
            response += ` (${row.extension})`;
          }

          return response;
        },
      },
      addLink: allowLinks,
      cancelToken,
      dataPreprocesor: async (rows) => {
        try {
          await genericForeignKeyResolver({
            data: Array.isArray(rows) ? rows : [rows],
            fkFld: 'extension',
            entity: Extension,
            addLink: false,
            cancelToken,
          });
        } catch {}
      },
    })
  );

  await Promise.all(promises);

  const iterable = Array.isArray(data) ? data : [data];

  for (const idx in iterable) {
    iterable[idx].duration = Math.round(iterable[idx].duration as number);
  }

  return data;
};

export default foreignKeyResolver;
