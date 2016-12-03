<?php
define('EOL', "<br>");
class Hero {
	public $hp;
	public $ap;
	public $rp;
	public $sp;
	public $da;
	public $df;
	public $name;
	private $a;
	private $b1;
	private $b2;
	public function initAttr() {
		$this->hp = 250 + rand() % 201;
		$this->ap = 0;
		$this->rp = rand() % 101;
		$this->sp = rand() % 101;
		$this->da = 42 + rand() % 59;
		$this->df = rand() % 101;
	}
	public function hit(Hero $h) {
		$p = rand() % 3;
		if ($p >= 0 && $p <= 1) {
			$this->yiquan($h);
		}
		if (p == 2) {
			$this->chutui($h);
		}
	}
	private function yiquan(Hero $h) {
		$a = 10 + rand() % 11;
		$b1 = rand() % 20 + $this->da * 0.5 - $h->df * 0.1;
		$b2 = 2 * $b1;
		
		echo sprintf("【%s】给了【%s】一拳" . EOL, $this->name,$h->name);		
		if ($this->rp - $h->rp > 80) {
			echo sprintf("造成了%s点暴击伤害" . EOL, $b2);
			$h->hp-= $b2;
			$h->ap+= $a;
		}
		if ($this->rp - $h->rp > 50 && $this->rp - $h->rp <= 80) {
			$q = rand() % 2;
			if ($q == 0) {
				echo sprintf("造成了%s点暴击伤害" . EOL, $b2);
				$h->hp-= $b2;
				$h->ap+= $a;
			}
			if ($q == 1) {
				echo sprintf("造成了%s点伤害" . EOL, $b1);
				$h->hp-= $b1;
				$h->ap+= $a;
			}
		}
		if ($this->rp - $h->rp > 0 && $this->rp - $h->rp <= 50) {
			$q = rand() % 5;
			if ($q == 0) {
				echo sprintf("造成了%s点暴击伤害" . EOL, $b2);
				$h->hp-= $b2;
				$h->ap+= $a;
			}
			if ($q > 0) {
				echo sprintf("造成了%s点伤害" . EOL, $b1);
				$h->hp-= $b1;
				$h->ap+= $a;
			}
		}
		if ($this->rp - $h->rp == 0) {
			echo sprintf("造成了%s点暴击伤害" . EOL, $b1);
			$h->hp-= $b1;
			$h->ap+= $a;
		}
	}
	private function chutui(Hero $h) {
		$a = 10 + rand() % 11;
		$b1 = rand() % 20 + $this->da * 0.5 - $h->df * 01.1;
		$b2 = 2 * $b1;
		echo sprintf("【%s】腾空而起，踹向【%s】" . EOL, $this->name, $h->name);
		$r = rand() / 5;
		if ($r == 0) {
			echo sprintf("但是没有踹到，摔了一跤受到%s点伤害" . EOL, $b1);
			$this->hp-= $b1;
		}
		if ($r > 0) {
			if ($this->rp - $h->rp > 80) {
				echo sprintf("造成了%s点暴击伤害" . EOL, $b2);
				$h->hp-= $b2;
				$h->ap+= $a;
			}
			if ($this->rp - $h->rp > 50 && $this->rp - $h->rp <= 80) {
				$q = rand() % 2;
				if ($q == 0) {
					echo sprintf("造成了%s点暴击伤害" . EOL, $b2);
					$h->hp-= $b2;
					$h->ap+= $a;
				}
				if ($q == 1) {
					echo sprintf("造成了%s点伤害" . EOL, $b1);
					$h->hp-= $b1;
					$h->ap+= $a;
				}
			}
			if ($this->rp - $h->rp > 0 && $this->rp - $h->rp <= 50) {
				$q = rand() % 5;
				if ($q == 0) {
					echo sprintf("造成了%s点暴击伤害" . EOL, $b2);
					$h->hp-= $b2;
					$h->ap+= $a;
				}
				if ($q > 0) {
					echo sprintf("造成了%s点伤害" . EOL, $b1);
					$h->hp-= $b1;
					$h->ap+= $a;
				}
			}
			if ($this->rp - $h->rp < 0) {
				echo sprintf("造成了%s点暴击伤害" . EOL, $b1);
				$h->hp-= $b1;
				$h->ap+= $a;
			}
		}
	}
	private function bite(Hero $h) {
		$b = 30 + rand() % 20 + $this->da * 0.5 - $h->df * 0.2;
		$a = 10 + rand() % 11;
		$p = rand() % 3;
		if ($p == 0) {
			echo sprintf("【%s】丧心病狂地冲上去咬了【%s】一口，但是皮太厚没咬动" . EOL, $this->name, $h->name);
		}
		if ($p > 0) {
			echo sprintf("【%s】丧心病狂地冲上去咬了【%s】一口，造成%s点伤害" . EOL, $this->name, $h->name, $b);
			$h->hp-= $b;
			$h->ap+= $a;
		}
	}
	private function curse(Hero $h) {
		$a = 10 + rand() % 11;
		echo sprintf("【%s】不甘心地蹲在地上画了个圈【%s】受到了诅咒，防御值降低了20，幸运值降低了20" . EOL, $this->name, $h->name);
		if ($h->df - 20 > 0) {
			$h->df-= 20;
			$h->ap+= $a;
		} else {
			$h->df = 0;
			$h->ap+= $a;
		}
	}
	private function poison(Hero $h) {
		$p = rand() % 3;
		$b = rand() % 20 + 30;
		$a = 10 + rand() % 11;
		if ($p == 0) {
			echo sprintf("【%s】暗中使用毒药时不小心弄错，自己受到了%s点伤害，速度值降低了20" . EOL, $this->name, $b);
			$this->hp-= $b;
			if ($this->sp - 20 > 0) {
				$this->sp-= 20;
			} else {
				$this->sp = 0;
			}
		}
		if ($p > 0) {
			echo sprintf("%s对%s暗中使用了毒药,造成了%s点伤害" . EOL, $this->name, $h->name, $b);
			$h->hp-= $b;
			$h->ap+= $a;
		}
	}
	private function trap(Hero $h) {
		$p = rand() % 3;
		$b1 = 35 + rand() % 20;
		$b2 = rand() % 20 + $this->da * 0.7 - $h->df * 0.1;
		$b3 = rand() % 20 + $h->da * 0.7 - $this->df * 0.1;
		$a = rand() % 11 + 10;
		if ($p == 0) {
			echo sprintf("【%s】挖陷阱时忘记做标记，自己掉了进去，受到了%s点伤害" . EOL, $this->name, $b1);
			echo sprintf("【%s】发现后落井下石，造成了%s点伤害" . EOL, $this->name, $b3);
			$this->hp = $this->hp - $b1 - $b3;
			$this->ap+= $a;
		}
		if ($p == 1) {
			echo sprintf("【%s】挖了一个陷阱，等待了半个小时，但是【%s】没有掉进去" . EOL, $this->name, $h->name);
		}
		if ($p == 2) {
			echo sprintf("【%s】挖了一个陷阱【%s】没有发现掉了进去，造成了%s伤害" . EOL, $this->name, $h->name, $b1);
			$h->hp = $h->hp - $b1 - $b2;
			$h->ap+= $a;
		}
	}
	private function cure(Hero $h) {
		echo sprintf("【%s】从口袋里掏出一个小豆花肉夹馍，两口吃了下去,生命值瞬间恢复了50点" . EOL, $this->name);
		echo sprintf("【%s】不禁后悔没有排队去买" . EOL, $h->name);
		$this->hp+= 50;
	}
	public function angry() {
		echo sprintf("【%s】从口袋里拿出了一张高数试卷，大大的59分触目惊心，怒气值飙涨50点" . EOL, $this->name);
		$this->ap+= 50;
	}
	public function crazy(Hero $h) {
		$b1 = 30 + rand() % 10 + $this->da * 0.4 - $this->df * 0.1;
		$b2 = 50 + rand() % 15 + $this->da * 0.5 - $this->df * 0.1;
		$b3 = 70 + rand() % 20 + $this->da * 0.6 - $this->df * 0.1;
		echo sprintf("【%s】暴走了，速度值增长了50点，武力值增加了50点，瞬间来到%s身前" . EOL, $this->name, $h->name);
		echo sprintf("【%s】左勾拳打中【%s】造成了%s点伤害" . EOL, $this->name, $h->name, $b1);
		echo sprintf("【%s】失去平衡" . EOL, $this->name);
		echo sprintf("【%s】侧身跟上，右勾拳打中【%s】造成了%s点伤害" . EOL, $this->name, $h->name, $b2);
		echo sprintf("【%s】无力招架" . EOL, $h->name);
		echo sprintf("【%s】火力全开，一拳轰出，一拳轰出,打中【%s】造成了%s点伤害" . EOL, $this->name, $h->name, $b3);
		$h->hp = $h->hp - $b1 - $b2 - $b3;
		$this->ap-= 40;
	}
	public function burst(Hero $h) {
		$b1 = 175 + rand() % 30 + $this->da * 0.5 - $this->df * 0.1;
		echo sprintf("【%s】小宇宙爆发了，刹那间山崩地裂，风云骤变" . EOL, $h->name);
		echo sprintf("【%s】恢复了100点生命值，武力值，防御值，暴涨100点" . EOL, $h->name);
		echo sprintf("【%s】闪现到了【%s】身后，给了【%s】全力一击，造成了%s点伤害" . EOL, $this->name, $h->name, $h->name, $b1);
		$this->hp+= 100;
		$this->da+= 100;
		$this->df+= 100;
		$h->hp-= $b1;
		$this->ap-= 50;
	}
	public function eye() {
		echo sprintf("【%s】擦了擦400度的眼镜，暴击率上升" . EOL, $h->name);
		$this->rp+= 50;
	}
	public function Decide(Hero $h) {
		$r = rand() % 101;
		if ($this->ap < 40) {
			if ($r >= 0 && $r < 20) {
				echo sprintf("【%s】发动了连击" . EOL, $this->name);
				$this->hit($h);
				$this->hit($h);
			}
			if ($r >= 20 && $r <= 100) {
				$this->hit($h);
			}
		} else if ($this->ap >= 40 && $this->ap < 80) {
			if ($r >= 0 && $r < 10) {
				echo sprintf("【%s】发动了连击" . EOL, $this->name);
				$this->hit($h);
				$this->hit($h);
			} else if ($r >= 10 && $r < 30) {
				$this->hit($h);
			} else if ($r >= 30 && $r < 40) {
				$this->bite($h);
			} else if ($r >= 40 && $r < 50) {
				$this->curse($h);
			} else if ($r >= 50 && $r < 60) {
				$this->poison($h);
			} else if ($r >= 60 && $r < 70) {
				$this->trap($h);
			} else if ($r >= 70 && $r < 80) {
				$this->cure($h);
			} else if ($r >= 80 && $r < 90) {
				$this->angry($h);
			} else if ($r >= 90 && $r < 100) {
				$this->eye($h);
			}
		} else if ($this->ap >= 80) {
			if ($r >= 0 && $r < 10) {
				echo sprintf("【%s】发动了连击" . EOL, $this->name);
				$this->hit($h);
				$this->hit($h);
			} else if ($r >= 10 && $r < 20) {
				$this->hit($h);
			} else if ($r >= 20 && $r < 25) {
				$this->crazy($h);
			} else if ($r >= 25 && $r < 30) {
				$this->burst($h);
			} else if ($r >= 30 && $r < 40) {
				$this->bite($h);
			} else if ($r >= 40 && $r < 50) {
				$this->curse($h);
			} else if ($r >= 50 && $r < 60) {
				$this->poison($h);
			} else if ($r >= 60 && $r < 70) {
				$this->trap($h);
			} else if ($r >= 70 && $r < 80) {
				$this->cure($h);
			} else if ($r >= 80 && $r < 90) {
				$this->angry($h);
			} else if ($r >= 90 && $r < 100) {
				$this->eye($h);
			}
		}
	}
	public function ShowAll() {
		echo sprintf("【%s】 生命值：%s 武力值：%s 防御值：%s 幸运值：%s 速度值：%s " . EOL, $this->name, $this->hp, $this->da, $this->df, $this->rp, $this->sp);
	}
	public function ShowHp() {
		echo sprintf("【%s】 生命值：%s 怒气：%s " . EOL, $this->name, $this->hp, $this->ap);
	}
	public function Claim(Hero $h) {
		echo sprintf("【%s】 被 【%s】 击败了" . EOL, $this->name, $h->name);
		$p = rand() % 3;
		if ($p == 0) {
		} else if ($p == 1) {
		} else if ($p == 2) {
		}
	}
}


$st = microtime(true);
$h1 = new Hero();
$h1->name = isset($_GET['a']) ? $_GET['a'] : '胡威';
$h1->initAttr();
$h2 = new Hero();
$h2->name = isset($_GET['b']) ? $_GET['b'] : '吴军';
$h2->initAttr();
$h1->ShowAll();
$h2->ShowAll();
$hp1 = 0;
$hp2 = 0;
while (ture) {
	$h1->Decide($h2);
	if ($h1->hp <= 0 || $h2->hp <= 0) {
		break;
	}
	$h2->Decide($h1);
	if ($h1->hp <= 0 || $h2->hp <= 0) {
		break;
	}
	$h1->ShowHp();
	$h2->ShowHp();
}
if ($h1->hp <= 0) {
	$h2->Claim($h1);
}
if ($h2->hp <= 0) {
	$h1->Claim($h2);
}
$et = microtime(true);

echo "计算耗时:".($et-$st);