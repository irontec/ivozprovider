import { autoForeignKeyResolver } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import genericForeignKeyResolver from '@irontec/ivoz-ui/services/api/genericForeigKeyResolver';
import store from 'store';

import { UsersCdrRow, UsersCdrRows } from './UsersCdrProperties';

function ownerResolver(row: UsersCdrRow): UsersCdrRow {
  if (row.direction === 'outbound') {
    row.owner = row.caller;
  } else {
    row.owner = row.callee;
  }

  return row;
}

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
    iterable[idx] = ownerResolver(iterable[idx]);
    iterable[idx].duration = Math.round(iterable[idx].duration as number);
  }

  return data;
};

export default foreignKeyResolver;
