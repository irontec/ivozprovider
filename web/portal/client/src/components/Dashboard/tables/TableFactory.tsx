import { useStoreState } from 'store';

import { DashboardData } from '../@types';
import { TableResidential } from './TableResidential';
import { TableRetail } from './TableRetail';
import { TableVpbx } from './TableVpbx';
import { TableWholeSale } from './TableWholeSale';

export const TableFactory = (props: {
  data: DashboardData;
}): JSX.Element | null => {
  const {
    latestBillableCalls,
    latestResidentialDevices,
    latestRetailAccounts,
    latestUsers,
  } = props.data;

  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);

  if (!aboutMe) {
    return null;
  }

  if (aboutMe?.wholesale) {
    return <TableWholeSale latestBillableCalls={latestBillableCalls} />;
  }

  if (aboutMe?.residential) {
    return (
      <TableResidential latestResidentialDevices={latestResidentialDevices} />
    );
  }

  if (aboutMe?.retail) {
    return <TableRetail latestRetailAccounts={latestRetailAccounts} />;
  }

  if (aboutMe?.vpbx) {
    return <TableVpbx latestUsers={latestUsers} />;
  }

  throw Error('Unknown client type.');
};
