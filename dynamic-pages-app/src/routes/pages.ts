import { Router } from 'express';
import { renderAboutPage } from '../controllers/pages';
import { renderAdvisoryBoardPage } from '../controllers/pages';
import { renderContactUsPage } from '../controllers/pages';
import { renderPrivacyPolicyPage } from '../controllers/pages';

const router = Router();

router.get('/about', renderAboutPage);
router.get('/advisory-board', renderAdvisoryBoardPage);
router.get('/contact-us', renderContactUsPage);
router.get('/privacy-policy', renderPrivacyPolicyPage);

export default router;