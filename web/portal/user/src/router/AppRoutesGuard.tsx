import ParsedApiSpecInterface from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { useStoreState } from 'store';

import Login from '../components/Login';
import AppRoutes from './AppRoutes';

export interface AppRoutesGuardProps {
  apiSpec: ParsedApiSpecInterface;
}

export default function AppRoutesGuard(props: AppRoutesGuardProps) {
  const loggedIn = useStoreState((state) => state.auth.loggedIn);

  if (!loggedIn) {
    return <Login />;
  }

  return <AppRoutes {...props} />;
}
